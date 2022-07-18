<x-app-layout>
    <div class="jumbotron text-center">
        <h1 class="display-4">Cypher System Calculator</h1>
    </div>
    <div id="form-container" class="border border-dark bg-danger mx-auto p-4 rounded">
        <form id="calc-form">
            <div class="row">
                <div class="col-12">
                    <input id="reset-btn" class="btn btn-warning mb-4" type="reset" value="Reset">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 order-0-md order-1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asset-select"><h3 class="font-weight-bold text-light">Assets:</h3></label>
                                <select name="asset" id="asset-select" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skills-select"><h3 class="font-weight-bold text-light">Skills:</h3></label>
                                <select name="skills" id="skills-select" class="form-control">
                                    <option value="0">None</option>
                                    <option value="1">Trained</option>
                                    <option value="2">2 Trained</option>
                                    <option value="2">Specialized</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="effort-select"><h3 class="font-weight-bold text-light">Effort:</h3></label>
                                <select name="effort" id="effort-select" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edge-select"><h3 class="font-weight-bold text-light">Edge:</h3></label>
                                <select name="edge" id="edge-select" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cost-counter"><h3 class="font-weight-bold text-light">Cost:</h3></label>
                                <h2 id="effort-cost" class="text-light text-center h2">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-0 order-md-1">
                    <p class="display-4 text-center text-light">Difficulty</p>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-sm-12 col-md-8">
                            <select id="difficulty-input" class="form-control-lg w-100">
                                <option value="0">0 Routine: Anyone can do this basically every time.</option>
                                <option value="1">1 Simple: Most people can do this most of the time.</option>
                                <option value="2">2 Standard: Typical task requiring focus, but most people can usually do this.</option>
                                <option value="3">3 Demanding: Requires full attention; most people have a 50/50 chance to succeed.</option>
                                <option value="4">4 Difficult: Trained people have a 50/50 chance to succeed.</option>
                                <option value="5">5 Challenging: Even trained people often fail.</option>
                                <option value="6">6 Intimidating: Normal people almost never succeed.</option>
                                <option value="7">7 Formidable: Impossible without skills or great effort.</option>
                                <option value="8">8 Heroic: A task worthy of tales told for years afterward.</option>
                                <option value="9">9 Immortal: A task worthy of legends that last lifetimes.</option>
                                <option value="10">10 Impossible: A task that normal humans couldn't consider (but one that doesn't break the laws of physics).</option>
                            </select>
                        </div>
                    </div>
                    <p id="final-difficulty" class="display-1 text-light text-center" style="">0/0</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="modifiers"><h3 class="font-weight-bold text-light">Modifiers:</h3></label>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="font-weight-bold text-light checkbox-header">Attacking</h4>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="prone-melee" value="1">
                                    <label for="prone-melee" class="form-check-label text-light">Prone target (melee) <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="prone-ranged" value="-1">
                                    <label for="prone-ranged" class="form-check-label text-light">Prone target (ranged) <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="cover" value="-1">
                                    <label for="cover" class="form-check-label text-light">Partial cover <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="high-ground" value="1">
                                    <label for="high-ground" class="form-check-label text-light">High ground <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="suprise-attack" value="2">
                                    <label for="suprise-attack" class="form-check-label text-light">Surprise attack <span class="mod-amt font-italic">-2</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="point-blank" value="1">
                                    <label for="point-blank" class="form-check-label text-light">Point-blank range <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="extreme-range" value="-1">
                                    <label for="extreme-range" class="form-check-label text-light">Extreme range <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="dim-light" value="-1">
                                    <label for="dim-light" class="form-check-label text-light">Dim light* <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="very-dim-light-point-blank" value="-1">
                                    <label for="very-dim-light-point-blank" class="form-check-label text-light">Very dim light point blank* <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="very-dim-light-short" value="-2">
                                    <label for="very-dim-light-short" class="form-check-label text-light">Very dim light short range* <span class="mod-amt font-italic">+2</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="darkness" value="-4">
                                    <label for="darkness" class="form-check-label text-light">Darkness* <span class="mod-amt font-italic">+4</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="mist" value="-1">
                                    <label for="mist" class="form-check-label text-light">Mist <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="obscured" value="-1">
                                    <label for="obscured" class="form-check-label text-light">Obscured <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="moving-target" value="-1">
                                    <label for="moving-target" class="form-check-label text-light">Moving Target <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="attacker-moving" value="-1">
                                    <label for="attacker-moving" class="form-check-label text-light">Moving* <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="attacker-jostled" value="-1">
                                    <label for="attacker-jostled" class="form-check-label text-light">Jostled* <span class="mod-amt font-italic">+1</span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="font-weight-bold text-light checkbox-header">Defending</h4>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="prone-melee-defend" value="-1">
                                    <label for="prone-melee-defend" class="form-check-label text-light">Prone (melee attacker) <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="prone-ranged-defend" value="1">
                                    <label for="prone-ranged-defend" class="form-check-label text-light">Prone (ranged attacker) <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="cover-defend" value="1">
                                    <label for="cover-defend" class="form-check-label text-light">Partial cover <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="high-ground-defend" value="-1">
                                    <label for="high-ground-defend" class="form-check-label text-light">High ground <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="suprise-attack-defend" value="-2">
                                    <label for="suprise-attack-defend" class="form-check-label text-light">Surprise attack <span class="mod-amt font-italic">+2</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="point-blank-defend" value="-1">
                                    <label for="point-blank-defend" class="form-check-label text-light">Point-blank range <span class="mod-amt font-italic">+1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="extreme-range-defend" value="1">
                                    <label for="extreme-range-defend" class="form-check-label text-light">Extreme range <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="dim-light-defend" value="1">
                                    <label for="dim-light-defend" class="form-check-label text-light">Dim light* <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="very-dim-light-point-blank-defend" value="1">
                                    <label for="very-dim-light-point-blank-defend" class="form-check-label text-light">Very dim light point blank* <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="very-dim-light-short-defend" value="2">
                                    <label for="very-dim-light-short-defend" class="form-check-label text-light">Very dim light short range* <span class="mod-amt font-italic">-2</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="darkness" value="4">
                                    <label for="darkness" class="form-check-label text-light">Darkness* <span class="mod-amt font-italic">-4</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="mist-defend" value="1">
                                    <label for="mist-defend" class="form-check-label text-light">Mist <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="obscured-defend" value="1">
                                    <label for="obscured-defend" class="form-check-label text-light">Obscured <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="moving-target-defend" value="1">
                                    <label for="moving-target-defend" class="form-check-label text-light">Moving <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="attacker-moving-defend" value="1">
                                    <label for="attacker-moving-defend" class="form-check-label text-light">Attacker moving* <span class="mod-amt font-italic">-1</span></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input mod-checkbox" id="attacker-jostled-defend" value="1">
                                    <label for="attacker-jostled-defend" class="form-check-label text-light">Attacker jostled* <span class="mod-amt font-italic">-1</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @vite('resources/js/cypher-calculator.js')
</x-app-layout>