$(document).ready(function() {
    let difficulty = 0
    let assets = 0
    let skills = 0
    let effort = 0
    let edge = 0
    let mods = 0
    let bonus = 0

    function calcFinalDifficulty() {
        let finalDifficulty = difficulty - (assets + skills + effort + mods)
        if (finalDifficulty > 10) {
            finalDifficulty = 10
        }
        if (finalDifficulty < 0) {
            finalDifficulty = 0
        }
        $('#final-difficulty').text(finalDifficulty+'/'+(finalDifficulty*3))
    }

    function calcEffortCost() {
        let effortCost = ((effort * 2) + 1) - edge
        if (effortCost < 0) {
            effortCost = 0
        }
        $('#effort-cost').text(effortCost)
    }

    $('#calc-form').on('reset', function() {
        difficulty = 0
        assets = 0
        skills = 0
        effort = 0
        edge = 0
        mods = 0
        $('#final-difficulty').text('0/0')
        $('#effort-cost').text('0')
    })

    $('#difficulty-input').on('change', function() {
        difficulty = parseInt($(this).val())
        calcFinalDifficulty()
    })

    $('#asset-select').on('change', function() {
        assets = parseInt($(this).val())
        calcFinalDifficulty()
    })

    $('#skills-select').on('change', function() {
        skills = parseInt($(this).val())
        calcFinalDifficulty()
    })

    $('#effort-select').on('change', function() {
        effort = parseInt($(this).val())
        calcFinalDifficulty()
        calcEffortCost()
    })

    $('#edge-select').on('change', function() {
        edge = parseInt($(this).val())
        calcEffortCost()
    })

    $('.mod-checkbox').on('click', function() {
        if ($(this).prop('checked')) {
            mods += parseInt($(this).val())
        }
        else {
            mods -= parseInt($(this).val())
        }
        calcFinalDifficulty()
    })
})