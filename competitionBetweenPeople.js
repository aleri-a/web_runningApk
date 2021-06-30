
const teams=document.getElementById("teamOfPeople"); //parentTeam
const peopleDiv=document.getElementById("peopleDivcxb");
const competitionID=document.getElementById("participationCompetitionID").value;
 //all teams which are under one team
 var allTeams=Array();
 var allPeople=[];
 var registredPpl=Array();
 


teams.onclick=(ev)=>ListenerChoosenTeam(ev);



function getSelectedOption(sel) {
    var opt;
    for ( var i = 0, len = sel.options.length; i < len; i++ ) {
        opt = sel.options[i];
        if ( opt.selected === true ) {
            break;
        }
    }
    return opt;
}

function ListenerChoosenTeam(ev)
{
    
   
    var idTeam=teams.value;
    var selected=getSelectedOption(teams);
    var id=selected.value;
    allPeople=[];
   
    console.log("id   :", id);
    console.log("idTeam   :", idTeam);
    peopleDiv.innerHTML=''; //obrise prethocno odstampane ljude
    

    //da li je registrovan vec taj tim za takmicenje to bitno da bi znali da li da cekiramo izbor ili ne (nema smisla ovde jer su svi ljudi u tom timu )
    // console.log("comeptitionif",competitionID);
    // fetch("jsonFje/getTeamsforCt.php?idCt="+competitionID)
    //     .then(res=>{
    //         console.log(res);
    //         if(!res.ok)
    //             throw Error(res.status);
    //         return res.json();
    //     })
    //     .then(res=>registredPt=res) 
    //     .catch(err=>console.log(err));
    //     console.log("registred");
    //     console.log(registredPt);

    console.log("comeptitionif",competitionID);
    fetch("jsonFje/getPeopleforCt.php?idCt="+competitionID+"&teamId="+idTeam)
        .then(res=>{
            console.log(res);
            if(!res.ok)
                throw Error(res.status);
            return res.json();
        })
        .then(res=>registredPpl=res)
        .catch(err=>console.log(err));
        console.log("registredPPL-----------------------------------------");
        console.log(registredPpl);


    //Da uzmem koji sve timovi spadaju pod neki tim tj koji su ispod njega 
    fetch("jsonFje/getTeamsUnder.php?idTeam="+idTeam)
        .then(res=>{
            if(!res.ok)
                throw Error(res.status);
            return res.json();
        })
        .then(underTeamss=>
            underTeamss.forEach(tm=>{
                console.log("tm   ",tm);
                fetch("jsonFje/getPeopleInTeam.php?idTeam="+tm)
                    .then(res=>{
                        if(!res.ok)
                            throw Error(res.status);
                        return res.json();
                    })
                    .then(peopleRes=>
                        {   
                            if(Object.keys(peopleRes).length>0)
                            {
                                peopleRes.forEach(el=>
                                showPerson(el));                        
                            }                    
                        }) //ovde navodis kako ti je zapravo u bazi napisano name, id i sta sve treba od parametara
                    .catch(err=>console.log(err));
                    })) //ovde navodis kako ti je zapravo u bazi napisano name, id i sta sve treba od parametara
        .catch(err=>console.log(err));
        //console.log("allTeams   ",allTeams);

        
       


}

function showPerson(person)
{
    //console.log("Usao u show people:  ",person);
    

        var inputHidden=document.createElement("input");
        inputHidden.setAttribute("type", "hidden");
        inputHidden.setAttribute("name", "peopleAll[]");
        inputHidden.setAttribute("id", "peopleAll");
        inputHidden.setAttribute("value", person['person_id']);     

        peopleDiv.appendChild(inputHidden);

        var formCheck=document.createElement("div");
        formCheck.setAttribute("class","form-check");

        var cxbChild=document.createElement("input");
        cxbChild.setAttribute("type", "checkbox");
        cxbChild.setAttribute("class", "form-check-input");
        cxbChild.setAttribute("name", "cxbPeople[]");
        cxbChild.setAttribute("id", "cxbPeople");
        cxbChild.setAttribute("value", person['person_id']);

         var vecRegistrovan=false;

        for(var i=0;i<registredPpl.length;i++)//ch==persin
        { 
            rg=registredPpl[i];
            if(rg['person_id']==person['person_id'])
            {
                vecRegistrovan=true;
                break;
            }
        }
       
         cxbChild.checked=vecRegistrovan;
        
         formCheck.appendChild(cxbChild);
    //    // console.log(ch['team_id']," je vec registrovan:  ", registredPt.includes(ch['team_id']));

        
        
        var lblChild=document.createElement("label");        
        lblChild.setAttribute("class", "form-check-label");        
        lblChild.setAttribute("value", person['firstname']);
        lblChild.innerHTML= person['firstname']+ " "+person['lastname']+" ("+ person['emailaddress']+") ";
        lblChild.htmlFor=person['person_id'];
        formCheck.appendChild(lblChild);


         peopleDiv.appendChild(formCheck);
        
    
}