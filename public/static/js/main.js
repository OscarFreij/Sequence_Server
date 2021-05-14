function searchUser()
{
    var querryUser = document.getElementById("querryUserInput").value;
    window.location.replace(location.protocol + '//' + location.host + location.pathname + "?page=search&uq="+querryUser);
}