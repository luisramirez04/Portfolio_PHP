httpRequest = new XMLHttpRequest();
if (!httpRequest) {
    alert("XMLHTTP Error");
}
const url = "https://api.github.com/users/luisramirez04/repos";

httpRequest.onreadystatechange = alertContents;
httpRequest.open("GET", url);
httpRequest.setRequestHeader("Accept", "application/vnd.github.mercy-preview+json");
httpRequest.send();

function alertContents() {
    if (httpRequest.readyState === XMLHttpRequest.DONE) {
        if (httpRequest.status == 200) {
            let jsonResponse = JSON.parse(httpRequest.responseText);
            displayRequestedData(jsonResponse);
        } else {
        console.log("There was an issue with the request");
        }
    }  
}

/*
This function takes all the data received from the ajax request, converts it to html table data
and then adds it to the page's table body using jQuery. Regex expressions are used to only use the year
for the data the project was made and to separate technologies with commas. 
*/
function displayRequestedData(data) {
    let projects = [];
    for(let i = 0; i < data.length; i++) {
        projects[i] = {};
        projects[i].name = data[i].name;
        projects[i].date = data[i].created_at;
        projects[i].description = data[i].description;
        projects[i].topics = data[i].topics;
    }

    let htmlToAdd = "";
    const regexForYear = /\d{4}/;
    for (let i = 0; i < projects.length; i++) {
        htmlToAdd += "<tr>";
        htmlToAdd += "<td>" + projects[i].name + "</td>"; 
        htmlToAdd += "<td class='projectDescription'>" + projects[i].description + "</td>"; 
        htmlToAdd += "<td>" + projects[i].topics.toString().replace(/,/g, ", ") + "</td>"; 
        htmlToAdd += "<td>" + projects[i].date.substring(0, 4) + "</td>"; 
        htmlToAdd += "</tr>";
    }

    $("tbody").html(htmlToAdd);
}