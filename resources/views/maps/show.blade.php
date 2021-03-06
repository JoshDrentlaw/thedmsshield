<?php
use App\Debug\Debug;
use App\Models\Marker;
$isDm = $isDm ? 1 : 0;
?>
@extends('layouts.app')

@section('content')
    <div id="map-container">
        @csrf
        <div id="map-sidebar" class="leaflet-sidebar collapsed">
            <!-- Nav tabs -->
            <div class="leaflet-sidebar-tabs">
                <ul role="tablist"> <!-- top aligned tabs -->
                    <li><a href="#the-table" role="tab" class="sidebar-tab-link"><i class="fa fa-users"></i></a></li>
                    <li><a href="#die-rollers" role="tab" class="sidebar-tab-link"><i class="fa fa-dice-d20"></i></a></li>
                    <li><a href="#compendium" role="tab" class="sidebar-tab-link"><i class="fa fa-book"></i></a></li>
                    <li class="d-none"><a href="#compendium-item" role="tab" class="sidebar-tab-link"></a></li>
                </ul>
                <!-- bottom aligned tabs -->
                @if($isDm)
                    <ul role="tablist">
                        <li><a href="#map-settings" role="tab" class="sidebar-tab-link"><i class="fa fa-cog"></i></a></li>
                    </ul>
                @endif
            </div>
            <!-- Tab panes -->
            <div class="leaflet-sidebar-content" style="background:#fff;">
                {{-- THE TABLE --}}
                <div class="leaflet-sidebar-pane" id="the-table">
                    <h1 class="leaflet-sidebar-header d-flex align-items-center justify-content-between">
                        The Table
                        <div class="leaflet-sidebar-close">
                            <i class="fa fa-caret-left"></i>
                        </div>
                    </h1>
                    <div class="py-3">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div id="logged-in-users-container">
                                    <h2>DM</h2>
                                    <div class="media mb-3" id="user-{{$campaign->dm->user->id}}">
                                        @if($campaign->dm->user->avatar_public_id)
                                            <img src="{{env('CLOUDINARY_IMG_PATH')}}c_thumb,w_100,h_100/v{{date('z')}}/{{$campaign->dm->user->avatar_public_id}}.jpg" class="mr-3">
                                        @else
                                            <div style="width:100px;height:100px;padding:0.25em;" class="img-thumbnail mr-3"><i class="fa fa-user w-100 h-100"></i></div>
                                        @endif
                                        <div class="media-body">
                                            <h3>
                                                {{$campaign->dm->user->username}}
                                            </h3>
                                            <h6>
                                                <span class="badge badge-danger online-indicator">Offline</span>
                                            </h6>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="color" data-user-id="{{$campaign->dm->user->id}}" class="user-map-color map-color-picker" value="{{$campaign->dm->user->map_color}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h2>Players</h2>
                                    @forelse($campaign->players as $player)
                                        <div class="media mb-3" id="user-{{$player->user->id}}">
                                            @if($player->user->avatar_public_id)
                                                <img src="{{env('CLOUDINARY_IMG_PATH')}}c_thumb,w_100,h_100/v{{date('z')}}/{{$player->user->avatar_public_id}}.jpg" class="mr-3">
                                            @else
                                                <div style="width:100px;height:100px;padding:0.25em;" class="img-thumbnail mr-3"><i class="fa fa-user w-100 h-100"></i></div>
                                            @endif
                                            <div class="media-body">
                                                <h3>
                                                    {{$player->user->username}}
                                                </h3>
                                                <h6>
                                                    <span class="badge badge-danger online-indicator">Offline</span>
                                                </h6>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input type="color" data-user-id="{{$player->user->id}}" class="user-map-color map-color-picker" value="{{$player->user->map_color}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- DIE ROLLER --}}
                <div class="leaflet-sidebar-pane" id="die-rollers">
                    <h1 class="leaflet-sidebar-header d-flex align-items-center justify-content-between">
                        Die Rollerz
                        <div class="leaflet-sidebar-close">
                            <i class="fa fa-caret-left"></i>
                        </div>
                    </h1>
                    <div class="py-3">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <form>
                                    <div class="form-row die-roll-group">
                                        <div class="col-auto my-2">
                                            <input type="number" value="1" min="1" style="width:55px;" class="die-amount form-control">
                                        </div>
                                        <div class="col-auto my-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text">D</label>
                                                </div>
                                                <select class="custom-select die-select">
                                                    <option value="4" selected>4</option>
                                                    <option value="6">6</option>
                                                    <option value="8">8</option>
                                                    <option value="10">10</option>
                                                    <option value="12">12</option>
                                                    <option value="20">20</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-auto my-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text">+</label>
                                                </div>
                                                <input type="number" value="0" min="1" style="width:55px;" class="mod-amount form-control">
                                            </div>
                                        </div>
                                        <div class="col-auto my-2">
                                            <button type="button" class="btn btn-primary" id="die-roll-btn">Roll!!</button>
                                        </div>
                                        <div class="col-auto my-2">
                                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="fa fa-angle-double-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="form-row die-roll-group">
                                            <div class="col-auto my-2">
                                                <input type="number" value="1" min="1" style="width:55px;" class="die-amount form-control">
                                            </div>
                                            <div class="col-auto my-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text">D</label>
                                                    </div>
                                                    <select class="custom-select die-select">
                                                        <option value="4" selected>4</option>
                                                        <option value="6">6</option>
                                                        <option value="8">8</option>
                                                        <option value="10">10</option>
                                                        <option value="12">12</option>
                                                        <option value="20">20</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto my-2">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text">+</label>
                                                    </div>
                                                    <input type="number" value="0" min="1" style="width:55px;" class="mod-amount form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2 w-100 border rounded">
                                        <ul class="list-unstyled mb-0 p-2" id="chat-message-list" style="box-shadow:inset -3px -11px 15px 0px #e2e2e2;">
                                            @forelse($messages->sortByDesc('created_at') as $message)
                                                <li class="media border rounded mb-4">
                                                    <div class="media-body">
                                                        <h5 class="my-0 p-2">{!!$message->message!!}</h5>
                                                        <div class="media p-2 border-top" style="background:#e9ecef;">
                                                            <div class="mr-2">
                                                                @if($message->user->avatar_public_id)
                                                                    <img src="{{env('CLOUDINARY_IMG_PATH')}}c_thumb,w_25,h_25/v{{date('z')}}/{{$message->user->avatar_public_id}}.jpg" alt="User avatar" class="rounded">
                                                                @else
                                                                    <div style="width:25px;height:25px;padding:0.25em;" class="rounded border"><i class="fa fa-user w-100 h-100"></i></div>
                                                                @endif
                                                            </div>
                                                            <div class="media-body d-flex align-items-center" style="height:25px;">
                                                                <span>{{$message->user->username}} <span class="chat-timestamp">{{$message->created_at->format('c')}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <p>Be the first to send a message</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                </form>         
                            </div>
                        </div>
                    </div>
                </div>
                {{-- COMPENDIUM --}}
                <div class="leaflet-sidebar-pane" id="compendium">
                    <h1 class="leaflet-sidebar-header d-flex align-items-center justify-content-between">
                        Compendium
                        <div class="leaflet-sidebar-close">
                            <i class="fa fa-caret-left"></i>
                        </div>
                    </h1>
                    <div style="overflow-y:auto;overflow-x:hidden;">
                        <x-compendium :campaign="$campaign" :is-dm="$isDm" path="map" />
                    </div>
                </div>
                {{-- COMPENDIUM itemType --}}
                <div class="leaflet-sidebar-pane" id="compendium-item">
                    <h1 class="leaflet-sidebar-header mb-4 d-flex align-items-center justify-content-between">
                        <span id="compendium-type-title"></span>
                        <div class="leaflet-sidebar-close d-block">
                            <i class="fa fa-caret-left"></i>
                        </div>
                    </h1>
                    <div id="compendium-item-container"></div>
                </div>
                {{-- MAP SETTINGS --}}
                @if($isDm)
                    <div class="leaflet-sidebar-pane" id="map-settings">
                        <h1 class="leaflet-sidebar-header d-flex align-items-center justify-content-between">
                            Map Settings
                            <div class="leaflet-sidebar-close">
                                <i class="fa fa-caret-left"></i>
                            </div>
                        </h1>
                        <div class="py-3">
                            <div class="row mb-2">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Map Bound Options</h5>
                                            <form id="bounds-form">
                                                <div class="form-group">
                                                    <label for="lat-bound">Lat bound</label>
                                                    <input type="text" class="form-control" id="lat-bound" name="latBound" value="{{$map->height}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lng-bound">Lng bound</label>
                                                    <input type="text" class="form-control" id="lng-bound" name="lngBound" value="{{$map->width}}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Player Marker Options</h5>
                                            <div class="form-group">
                                                <label>Player Marker Icon</label>
                                                <select id="player-marker-icon-select">
                                                    <?php
                                                        $marker = new Marker;
                                                    ?>
                                                    @foreach($marker->player_icons as $icon)
                                                        <?php
                                                            $text = Str::title(str_replace('-', ' ', $icon));
                                                        ?>
                                                        <option value="{{$icon}}">{{$text}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Player Marker Color</label>
                                                <input type="color" class="map-color-picker" id="player-marker-color" value="{{$map->player_marker_color}}">
                                            </div>
                                            <div class="form-group" style="display:none;">
                                                <label>Player Marker Selected Color</label>
                                                <input type="color" class="map-color-picker" id="player-marker-selected-color" value="{{$map->player_marker_selected_color}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- NEW COMPENDIUM ITEM MODAL --}}
    <div class="modal" id="new-compendium-item-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-compendium-item-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-create-compendium-item />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="new-compendium-item-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE COMPENDIUM ITEM MODAL --}}
    <div class="modal" id="delete-compendium-item-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete <span class="compendium-item-type text-capitalize"></span>?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This will permanently delete the selected <span class="compendium-item-type"></span>.</p>
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-compendium-item">Delete <span class="compendium-item-type text-capitalize"></span></button>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE MARKER MODAL --}}
    <div class="modal" id="delete-marker-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete marker?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This will permanently delete the selected marker.</p>
                    <p>Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="delete-marker">Delete marker</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const map = L.map('map-container', {
            crs: L.CRS.Simple,
            minZoom: -10,
            keepInView: true,
            zoomSnap: 0.05,
            zoomDelta: 0.5,
            // drawControl: true
        }),
        mapModel = {!!$map!!},
            CLOUDINARY_IMG_PATH = '{!!env('CLOUDINARY_IMG_PATH')!!}'
        let mapUrl = '{!!$map_url!!}'
        let map_id = {!!$map->id!!}
        let user_id = {!!$user_id!!}
        let mapWidth = {!!$map->width!!}
        let mapHeight = {!!$map->height!!}
        let markers = {!!json_encode($markers)!!}
        let campaign = {!!$campaign!!}
        let campaign_id = {!!$campaign->id!!}
        let isDm = {!!$isDm!!}
        let place_id = ''
        let thing_id = ''
        let idea_id = ''
        let creature_id = ''
        let sidebar
        let showMessage
        let campaignMapChannel
        let compendiumChannel
        let mapMarkers = []
        let setSelectedMarker
        let getSelectedMarker
        let deleteMapMarker

        new Promise((res, rej) => {
            while (!Echo.socketId) {
                setTimeout(() => {}, 50)
            }
            res(true)
        }).then(() => {
            campaignMapChannel = Echo.join(`campaign-map-${map_id}`)
            .here(users => {
                toggleLoggedInUsers(users, 'Online')
            })
            .joining(user => {
                toggleLoggedInUser(user, 'Online')
            })
            .leaving(user => {
                toggleLoggedInUser(user, 'Offline')
            })

            compendiumChannel = Echo.private(`compendium-${campaign_id}`)
            compendiumChannel.listen('PlaceUpdate', e => {
                console.log(e)
                if (e.placeUpdate.type === 'edit') {
                    if (e.placeUpdate.id == $('#place-id').val()) {
                        $('.show-place-name').text(e.placeUpdate.name)
                        let html = e.placeUpdate.name
                        if ($('#marker-id').length) {
                            html += `
                                <i class="fa fa-map-marker-alt"></i>
                                <small class="text-muted">${mapModel.name}</small>
                            `
                        }
                        $(`.compendium-place[data-place-id="${place_id}"]`).html(html)
                        $('.show-place-body-display').html(e.placeUpdate.body)
                    }
                } else if (e.placeUpdate.type === 'showToPlayers') {
                    if (e.placeUpdate.markerless) {
                        axios.post('/places/show_component', {id: e.placeUpdate.id, isDm: false})
                        .then(({ data }) => {
                            if (data.status === 200) {
                                sidebar.open('compendium-item')
                                $('#compendium-item-container').html(data.showComponent)
                            }
                        })
                    } else {
                        getSelectedMarker(e.placeUpdate.markerId, true)
                    }
                } else if (e.placeUpdate.type === 'newPlace') {
                    $(`#compendium-places-list`).find('.first-item').remove()
                    $(`#compendium-places-list`).append(`
                        <a class="list-group-item list-group-item-action interactive dmshield-link compendium-place compendium-item show" data-place-id="${e.placeUpdate.place.id}">
                            ${e.placeUpdate.place.name}
                        </a>
                    `)
                } else if (e.placeUpdate.type === 'visibility') {
                    const $compendiumItem = $(`.compendium-place[data-place-id="${e.placeUpdate.id}"]`)
                    if (e.placeUpdate.visible) {
                        $compendiumItem.removeClass('d-none')
                    } else {
                        $compendiumItem.addClass('d-none')
                    }
                    if (e.placeUpdate.hasMarker) {
                        mapMarkers.forEach(mapMarker => {
                            if (mapMarker.options.id == e.placeUpdate.marker.id) {
                                if (e.placeUpdate.visible && e.placeUpdate.markerVisible) {
                                    mapMarker.addTo(map)
                                    $('#marker-location').removeClass('d-none')
                                    $compendiumItem.find('.marker-location').removeClass('d-none')
                                } else {
                                    mapMarker.removeFrom(map)
                                    $('#marker-location').addClass('d-none')
                                    $compendiumItem.find('.marker-location').addClass('d-none')
                                    sidebar.close()
                                }
                            }
                        })
                    }
                } else if (e.placeUpdate.type === 'delete') {
                    if ($('#compendium-item').hasClass('active')) {
                        sidebar.open('compendium')
                    }
                    $(`.compendium-place[data-place-id="${e.placeUpdate.id}"]`).remove()
                    let marker = mapMarkers.filter(m => m.options.id == e.markerUpdate.id)[0]
                    marker.removeFrom(map)
                }
            }).listen('CreatureUpdate', e => {
                if (e.creatureUpdate.type === 'edit') {
                    if (e.creatureUpdate.id == $('#creature-id').val()) {
                        $('.show-creature-name').text(e.creatureUpdate.name)
                        let html = e.creatureUpdate.name
                        if ($('#marker-id').length) {
                            html += `
                                <i class="fa fa-map-marker-alt"></i>
                                <small class="text-muted">${mapModel.name}</small>
                            `
                        }
                        $(`.compendium-creature[data-creature-id="${creature_id}"]`).html(html)
                        $('.show-creature-body-display').html(e.creatureUpdate.body)
                    }
                } else if (e.creatureUpdate.type === 'showToPlayers') {
                    if (e.creatureUpdate.markerless) {
                        axios.post('/creatures/show_component', {id: e.creatureUpdate.id, isDm: false})
                        .then(({ data }) => {
                            if (data.status === 200) {
                                sidebar.open('creature-marker')
                                $('#creature-marker-container').html(data.showComponent)
                            }
                        })
                    } else {
                        getSelectedMarker(e.creatureUpdate.markerId, true)
                    }
                } else if (e.creatureUpdate.type === 'newCreature') {
                    $(`#compendium-creatures-list`).find('.first-item').remove()
                    $(`#compendium-creatures-list`).append(`
                        <a class="list-group-item list-group-item-action interactive dmshield-link compendium-creature compendium-item show" data-creature-id="${e.creatureUpdate.creature.id}">
                            ${e.creatureUpdate.creature.name}
                        </a>
                    `)
                } else if (e.creatureUpdate.type === 'visibility') {
                    const $compendiumItem = $(`.compendium-creature[data-creature-id="${e.creatureUpdate.id}"]`)
                    if (e.creatureUpdate.visible) {
                        $compendiumItem.removeClass('d-none')
                    } else {
                        $compendiumItem.addClass('d-none')
                    }
                    if (e.creatureUpdate.hasMarker) {
                        mapMarkers.forEach(mapMarker => {
                            if (mapMarker.options.id == e.creatureUpdate.marker.id) {
                                if (e.creatureUpdate.visible && e.creatureUpdate.markerVisible) {
                                    mapMarker.addTo(map)
                                    $('#marker-location').removeClass('d-none')
                                    $compendiumItem.find('.marker-location').removeClass('d-none')
                                } else {
                                    mapMarker.removeFrom(map)
                                    $('#marker-location').addClass('d-none')
                                    $compendiumItem.find('.marker-location').addClass('d-none')
                                    sidebar.close()
                                }
                            }
                        })
                    }
                } else if (e.creatureUpdate.type === 'delete') {
                    if ($('#compendium-item').hasClass('active')) {
                        sidebar.open('compendium')
                    }
                    $(`.compendium-creature[data-creature-id="${e.creatureUpdate.id}"]`).remove()
                    let marker = mapMarkers.filter(m => m.options.id == e.markerUpdate.id)[0]
                    marker.removeFrom(map)
                }
            }).listen('OrganizationUpdate', e => {
                if (e.organizationUpdate.type === 'edit') {
                    if (e.organizationUpdate.id == $('#organization-id').val()) {
                        $('.show-organization-name').text(e.organizationUpdate.name)
                        let html = e.organizationUpdate.name
                        if ($('#marker-id').length) {
                            html += `
                                <i class="fa fa-map-marker-alt"></i>
                                <small class="text-muted">${mapModel.name}</small>
                            `
                        }
                        $(`.compendium-organization[data-organization-id="${organization_id}"]`).html(html)
                        $('.show-organization-body-display').html(e.organizationUpdate.body)
                    }
                } else if (e.organizationUpdate.type === 'showToPlayers') {
                    if (e.organizationUpdate.markerless) {
                        axios.post('/organizations/show_component', {id: e.organizationUpdate.id, isDm: false})
                        .then(({ data }) => {
                            if (data.status === 200) {
                                sidebar.open('organization-marker')
                                $('#organization-marker-container').html(data.showComponent)
                            }
                        })
                    } else {
                        getSelectedMarker(e.organizationUpdate.markerId, true)
                    }
                } else if (e.organizationUpdate.type === 'newOrganization') {
                    $(`#compendium-organizations-list`).find('.first-item').remove()
                    $(`#compendium-organizations-list`).append(`
                        <a class="list-group-item list-group-item-action interactive dmshield-link compendium-organization compendium-item show" data-organization-id="${e.organizationUpdate.organization.id}">
                            ${e.organizationUpdate.organization.name}
                        </a>
                    `)
                } else if (e.organizationUpdate.type === 'visibility') {
                    const $compendiumItem = $(`.compendium-organization[data-organization-id="${e.organizationUpdate.id}"]`)
                    if (e.organizationUpdate.visible) {
                        $compendiumItem.removeClass('d-none')
                    } else {
                        $compendiumItem.addClass('d-none')
                    }
                    if (e.organizationUpdate.hasMarker) {
                        mapMarkers.forEach(mapMarker => {
                            if (mapMarker.options.id == e.organizationUpdate.marker.id) {
                                if (e.organizationUpdate.visible && e.organizationUpdate.markerVisible) {
                                    mapMarker.addTo(map)
                                    $('#marker-location').removeClass('d-none')
                                    $compendiumItem.find('.marker-location').removeClass('d-none')
                                } else {
                                    mapMarker.removeFrom(map)
                                    $('#marker-location').addClass('d-none')
                                    $compendiumItem.find('.marker-location').addClass('d-none')
                                    sidebar.close()
                                }
                            }
                        })
                    }
                } else if (e.organizationUpdate.type === 'delete') {
                    if ($('#compendium-item').hasClass('active')) {
                        sidebar.open('compendium')
                    }
                    $(`.compendium-organization[data-organization-id="${e.organizationUpdate.id}"]`).remove()
                    let marker = mapMarkers.filter(m => m.options.id == e.markerUpdate.id)[0]
                    marker.removeFrom(map)
                }
            }).listen('ItemUpdate', e => {
                if (e.itemUpdate.type === 'edit') {
                    if (e.itemUpdate.id == $('#item-id').val()) {
                        $('.show-item-name').text(e.itemUpdate.name)
                        let html = e.itemUpdate.name
                        if ($('#marker-id').length) {
                            html += `
                                <i class="fa fa-map-marker-alt"></i>
                                <small class="text-muted">${mapModel.name}</small>
                            `
                        }
                        $(`.compendium-item[data-item-id="${item_id}"]`).html(html)
                        $('.show-item-body-display').html(e.itemUpdate.body)
                    }
                } else if (e.itemUpdate.type === 'showToPlayers') {
                    if (e.itemUpdate.markerless) {
                        axios.post('/items/show_component', {id: e.itemUpdate.id, isDm: false})
                        .then(({ data }) => {
                            if (data.status === 200) {
                                sidebar.open('item-marker')
                                $('#item-marker-container').html(data.showComponent)
                            }
                        })
                    } else {
                        getSelectedMarker(e.itemUpdate.markerId, true)
                    }
                } else if (e.itemUpdate.type === 'newItem') {
                    $(`#compendium-items-list`).find('.first-item').remove()
                    $(`#compendium-items-list`).append(`
                        <a class="list-group-item list-group-item-action interactive dmshield-link compendium-item compendium-item show" data-item-id="${e.itemUpdate.item.id}">
                            ${e.itemUpdate.item.name}
                        </a>
                    `)
                } else if (e.itemUpdate.type === 'visibility') {
                    const $compendiumItem = $(`.compendium-item[data-item-id="${e.itemUpdate.id}"]`)
                    if (e.itemUpdate.visible) {
                        $compendiumItem.removeClass('d-none')
                    } else {
                        $compendiumItem.addClass('d-none')
                    }
                    if (e.itemUpdate.hasMarker) {
                        mapMarkers.forEach(mapMarker => {
                            if (mapMarker.options.id == e.itemUpdate.marker.id) {
                                if (e.itemUpdate.visible && e.itemUpdate.markerVisible) {
                                    mapMarker.addTo(map)
                                    $('#marker-location').removeClass('d-none')
                                    $compendiumItem.find('.marker-location').removeClass('d-none')
                                } else {
                                    mapMarker.removeFrom(map)
                                    $('#marker-location').addClass('d-none')
                                    $compendiumItem.find('.marker-location').addClass('d-none')
                                    sidebar.close()
                                }
                            }
                        })
                    }
                } else if (e.itemUpdate.type === 'delete') {
                    if ($('#compendium-item').hasClass('active')) {
                        sidebar.open('compendium')
                    }
                    $(`.compendium-item[data-item-id="${e.itemUpdate.id}"]`).remove()
                    let marker = mapMarkers.filter(m => m.options.id == e.markerUpdate.id)[0]
                    marker.removeFrom(map)
                }
            })
        })

        function toggleLoggedInUsers(users, status) {
            users.forEach(u => {
                toggleLoggedInUser(u, status)
            })
        }

        function toggleLoggedInUser(user, status) {
            const $ind = $(`#user-${user.id}`).find('.online-indicator')
            console.log($ind)

            $ind.toggleClass('badge-success badge-danger')
            $ind.text(status)
        }
    </script>

    <script src="{{ asset('js/maps.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/compendium.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/placeOptions.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/creatureOptions.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/organizationOptions.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/itemOptions.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/die-roller.js') . '?' . time() }}"></script>
    <script src="{{ asset('js/mapChatMessages.js') . '?' . time() }}"></script>
@endsection