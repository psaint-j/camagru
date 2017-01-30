function selectOnlyThis(id) {
    for (var i = 1;i <= 4; i++)
    {
        document.getElementById("cbox" + i).checked = false;
    }
    document.getElementById(id).checked = true;
}