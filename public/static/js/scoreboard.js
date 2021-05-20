function GetMoreScores()
{

    var searchParams = new URLSearchParams(window.location.search);
    var request_diff = searchParams.get("diff");
    
    var reqeust_nr;
    
    try
    {
        reqeust_nr = document.getElementById("display").lastChild.childNodes[1].innerText;    
    }
    catch (error)
    {
        console.error("No elements found to get id from.");
        document.getElementById("loadBtn").disabled = true;
        document.getElementById("loadBtn").innerText = "There are no scores!";
        return;
    }
    
    var requestStuff = "displayRequest="+request_diff+"_"+reqeust_nr;
    console.log(requestStuff);
    
    var myFirstPromise = new Promise((resolve, reject) => {
        
        document.getElementById("loadingGIF").style.display = "block";
        document.getElementById("loadBtn").disabled = true;

        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "callback.php/?action=display", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(requestStuff);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            var dataReturn = JSON.parse(this.responseText).data;
            if (dataReturn.length > 0)
            {
                dataReturn.forEach(element => {
                    document.getElementById("display").innerHTML += element;
                });
            }
            else
            {
                resolve(false);
            }
            
            resolve(true);
            }
        };
    })
    
    myFirstPromise.then((successMessage) => {
        document.getElementById("loadingGIF").style.display = "none";
        if (successMessage)
        {
            document.getElementById("loadBtn").disabled = false;
        }
        else
        {
            document.getElementById("loadBtn").disabled = true;
            document.getElementById("loadBtn").innerText = "There are no more scores!";
        }
        
    });
    console.log(myFirstPromise);
    return myFirstPromise;
}