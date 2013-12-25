<div class="panel">
    <div class="panel-body">
        <input type="hidden" id="team_id" value="<?= $team_id ?>">
        <input type="hidden" id="team_name" value="<?= urldecode($team_name) ?>">
        <input type="hidden" id="game_id" value="<?= $game_id ?>">
        <input type="hidden" id="load_game" value="<?=(isset($load_game) ? '1' : '0' );?>">
        <h3><span class="label label-success" id="status"></span></h3>
        <div class="scContainer">
            <canvas class="bg" id="bg"></canvas>
            <canvas class="fg" id="fg"></canvas>
        </div>
        <div class="controlArea" id="controlArea">
            <div id="accordion">
                <h3>Hits/Walks</h3>
                <div>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('S')">Single</button>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('D')">Double</button><br>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('T')">Triple</button>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('H')">Home Run!</button><br>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('W')">Walk</button>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('I')">Intentional Walk</button>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('B')">Hit By Pitch</button>
                </div>
                <h3>Outs</h3>
                <div>
                    <button type="button" class="fly-out">Fly Ball</button>
                    <button type="button" class="ground-out">Ground Ball</button>
                    <button type="button" class="pop-out">Pop Up</button>
                    <button type="button" class="fielders-choice-out brOptions">Fielder's Choice</button>
                    <button type="button" class="next-ab" onclick="scoreCard.processAB('K')">Strikeout</button>
                    <button type="button" class="next-ab sac brOptions" onclick="scoreCard.processAB('SF')">Sac Fly</button>
                    <button type="button" class="next-ab sac brOptions" onclick="scoreCard.processAB('SH')">Sac Hit/Bunt</button>
                </div>
                <h3>Base Running Events</h3>
                <div>
                    <button type="button" class="on-base fbOptions steal2" onclick="scoreCard.preAB('SB12')">Steal 2nd</button>
                    <button type="button" class="on-base sbOptions steal3" onclick="scoreCard.preAB('SB23')">Steal 3rd</button>
                    <button type="button" class="on-base tbOptions" onclick="scoreCard.preAB('SB3H')">Steal Home</button>
                    <button type="button" class="on-base dsOptions" onclick="scoreCard.preAB('SBDS')">Double Steal</button>
                    <button type="button" class="on-base tsOptions" onclick="scoreCard.preAB('SBTS')">Triple Steal</button>
                    <button type="button" class="on-base fbOptions" onclick="scoreCard.preAB('CS12')">CS 2nd</button>
                    <button type="button" class="on-base sbOptions" onclick="scoreCard.preAB('CS23')">CS 3rd</button>
                    <button type="button" class="on-base tbOptions" onclick="scoreCard.preAB('CS3H')">CS Home</button>
                    <button type="button" class="on-base fbOptions" onclick="scoreCard.preAB('PO1')">PO 1st</button>
                    <button type="button" class="on-base sbOptions" onclick="scoreCard.preAB('PO2')">PO 2nd</button>
                    <button type="button" class="on-base tbOptions" onclick="scoreCard.preAB('PO3')">PO 3rd</button>
                    <button type="button" class="on-base" onclick="scoreCard.preAB('BK')">Balk</button>
                </div>
                <h3>Double Play</h3>
                <div>
                    <button type="button" id="1H" class="dp fbOptions">1st & 2nd</button>
                    <button type="button" id="2H" class="dp sbOptions">1st & 3rd</button>
                    <button type="button" id="3H" class="dp tbOptions">1st & Home</button>
                    <button type="button" id="21" class="dp dp21Options">2nd & 3rd</button>
                    <button type="button" id="31" class="dp dp31Options">2nd & Home</button>
                    <button type="button" id="32dp" class="dp dp32Options">3rd & Home</button>
                </div>
                <h3>Triple Play</h3>
                <div>
                    <button type="button" id="123" class="tp tp123Options">1st & 2nd & 3rd</button>
                    <button type="button" id="12H" class="tp tp12HOptions">1st & 2nd & Home</button>
                    <button type="button" id="13H" class="tp tp13HOptions">1st & 3rd & Home</button>
                    <button type="button" id="23H" class="tp tp23HOptions">2nd & 3rd & Home</button>
                </div>
                <h3>Options</h3>
                <div>
                    <button type="button" class="options" id="undo">Undo Last Play</button>
                    <button type="button" class="options" id="close">Close Game</button>
                    <button type="button" class="options" id="end">End Game</button>
                </div>
            </div>
        </div>
        <div id="ground-out-dialog" title="Out from">
            <div>
                <button type="button" class="go" id="13">Pitcher to 1st</button>
                <button type="button" class="go" id="23">Catcher to 1st</button>
                <button type="button" class="go" id="43">2nd to 1st</button>
                <button type="button" class="go" id="53">3rd to 1st</button>
                <button type="button" class="go" id="63">Shortstop to 1st</button>
                <button type="button" class="go" id="33">1st Unassisted</button>
            </div>
        </div>
        <div id="fly-out-dialog" title="Out to">
            <div>
                <button type="button" class="fo" id="7">Left Fielder</button>
                <button type="button" class="fo" id="8">Center Fielder</button>
                <button type="button" class="fo" id="9">Right Fielder</button>
            </div>
        </div>
        <div id="pop-out-dialog" title="Out to">
            <div>
                <button type="button" class="po" id="1">Pitcher</button>
                <button type="button" class="po" id="2">Catcher</button>
                <button type="button" class="po" id="3">1st Base</button>
                <button type="button" class="po" id="4">2nd Base</button>
                <button type="button" class="po" id="5">3rd Base</button>
                <button type="button" class="po" id="6">Shortstop</button>
            </div>
        </div>
        <div id="fielders-choice-out-dialog" title="Out at">
            <div>
                <div>
                    <button type="button" class="fco fbOptions" id="14">P to 2nd</button>
                    <button type="button" class="fco fbOptions" id="24">C to 2nd</button>
                    <button type="button" class="fco fbOptions" id="34">1st to 2nd</button>
                    <button type="button" class="fco fbOptions" id="64">SS to 2nd</button>
                    <button type="button" class="fco fbOptions" id="54">3rd to 2nd</button>
                    <button type="button" class="fco fbOptions" id="44">2nd Unassisted</button>
                </div>
                <div>
                    <button type="button" class="fco fbOptions" id="16">P to SS</button>
                    <button type="button" class="fco fbOptions" id="26">C to SS</button>
                    <button type="button" class="fco fbOptions" id="36">1st to SS</button>
                    <button type="button" class="fco fbOptions" id="46">2nd to SS</button>
                    <button type="button" class="fco fbOptions" id="56">3rd to SS</button>
                    <button type="button" class="fco fbOptions" id="66">SS Unassisted</button>
                </div>
                <div>
                    <button type="button" class="fco sbOptions" id="15">P to 3rd</button>
                    <button type="button" class="fco sbOptions" id="25">C to 3rd</button>
                    <button type="button" class="fco sbOptions" id="35">1st to 3rd</button>
                    <button type="button" class="fco sbOptions" id="45">2nd to 3rd</button>
                    <button type="button" class="fco sbOptions" id="65">SS to 3rd</button>
                    <button type="button" class="fco sbOptions" id="55">3rd Unassisted</button>
                </div>
                <div>
                    <button type="button" class="fco tbOptions" id="12">P to C</button>
                    <button type="button" class="fco tbOptions" id="32">1st to C</button>
                    <button type="button" class="fco tbOptions" id="42">2nd to C</button>
                    <button type="button" class="fco tbOptions" id="52">3rd to C</button>
                    <button type="button" class="fco tbOptions" id="62">SS to C</button>
                    <button type="button" class="fco tbOptions" id="22">C Unassisted</button>
                </div>
            </div>
        </div>
    </div>
</div>