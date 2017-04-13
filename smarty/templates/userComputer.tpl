{extends file="home.tpl"}
{block name=MainPanel}
    <div class="form-group">
        <label for="compHostName">Computer Host Name:</label>
        <input type="text" class="form-control" id="compHostName" value="{$computer.ComputerHostName}">
    </div>
{/block}