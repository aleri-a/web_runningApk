
console.log("uso u js");
//for option 2-subteams
const parentTeam=document.getElementById("perentTeamOfSubteams");
const chldrenTeamsdiv=document.getElementById("chldrenTeamscxb");
const competitionID=document.getElementById("participationCompetitionID").value;
//console.log("ctID  ",competitionID.value);
var registredPt=Array();

    parentTeam.onclick=(ev)=>ListenerChoosenParent(ev);


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



function ListenerChoosenParent(ev)
{

    var idParent=parentTeam.value;
    var selected=getSelectedOption(parentTeam);
    var id=selected.value;
    console.log("usao u LIstener, selected je:   ", selected);

    console.log("id parenta:")
    console.log(id);


    console.log("comeptitionif",competitionID);
    fetch("jsonFje/getTeamsforCt.php?idCt="+competitionID)
        .then(res=>{
            console.log(res);
            if(!res.ok)
                throw Error(res.status);
            return res.json();
        })
        .then(res=>registredPt=res) //ovde navodis kako ti je zapravo u bazi napisano name, id i sta sve treba od parametara
        .catch(err=>console.log(err));
        console.log("registred");
        console.log(registredPt);

    fetch("jsonFje/getChildrenTeams.php?idP="+idParent)
        .then(res=>{
            console.log(res);
            if(!res.ok)
                throw Error(res.status);
            return res.json();
        })
        .then(childTeams=>showChildTeams(childTeams)) //ovde navodis kako ti je zapravo u bazi napisano name, id i sta sve treba od parametara
        .catch(err=>console.log(err));
}

function showChildTeams(children)
{
    chldrenTeamsdiv.innerHTML='';
    children.forEach(ch => {
        //chldrenTeamsdiv
        //console.log(ch);
        var inputHidden=document.createElement("input");
        inputHidden.setAttribute("type", "hidden");
        inputHidden.setAttribute("name", "cxbSubteamsAll[]");
        inputHidden.setAttribute("id", "cxbSubteamsAll");
        inputHidden.setAttribute("value", ch['team_id']);     

        chldrenTeamsdiv.appendChild(inputHidden);

        var formCheck=document.createElement("div");
        formCheck.setAttribute("class","form-check");

        var cxbChild=document.createElement("input");
        cxbChild.setAttribute("type", "checkbox");
        cxbChild.setAttribute("class", "form-check-input");
        cxbChild.setAttribute("name", "cxbSubteams[]");
        cxbChild.setAttribute("id", "cxbSubteam");
        cxbChild.setAttribute("value", ch['team_id']);

        var vecRegistrovan=false;

        for(var i=0;i<registredPt.length;i++)
        { 
            rg=registredPt[i];
            if(rg['team_id']==ch['team_id'])
            {
                vecRegistrovan=true;
                break;
            }
        }
       
        cxbChild.checked=vecRegistrovan;
        
        formCheck.appendChild(cxbChild);
       // console.log(ch['team_id']," je vec registrovan:  ", registredPt.includes(ch['team_id']));

        
        
        var lblChild=document.createElement("label");        
        lblChild.setAttribute("class", "form-check-label");        
        lblChild.setAttribute("value", ch['name']);
        lblChild.innerHTML= ch['name'];
        lblChild.htmlFor=ch['team_id'];
        formCheck.appendChild(lblChild);


        chldrenTeamsdiv.appendChild(formCheck);
        
    });
}

//function HTML()
// {
//     <input type="hidden" id="cxbteamsOnlyAll" name="cxbteamsOnlyAll[]"  value="<?php echo $tp['team_id']?>">
//     <div class="form-check">
//     <input
//         class="form-check-input"
//         type="checkbox"
//         value="<?php echo $tp['team_id']?>"
//         name="cxbTeamsOnly[]"
//         id="cxbTeamsOnly"
//         <?php  
//             if(in_array($tp['team_id'] ,$regTeamsForCt)){
//                 echo "checked";
//             }
//         ?>
//     />
//     <label class="form-check-label" for="flexCheckDefault">
//         <?php echo $tp['name']?>
//     </label>
//     </div>
//}


// function tableSelectParticipants(participantsList,name,id)
// {
//     console.log('U fji izbor ucesnika');
//     console.log(tableSelectParticipant);
//     tableSelectParticipant.innerHTML=
//     "<thead><tr>\n\
//     <th>Name</th> <th>btns</th>  </tr></thead><tbody>  </tbody>";

//     var tableBody=tableSelectParticipant.getElementsByTagName('tbody')[0];
//   //  console.log(tableBody);
//     participantsList.forEach( elem=>{
//         tableBody.innerHTML+="<tr><td>"+elem[name]+"</td><td><button name='addParticipant' id="+elem[id]+">Add </button></td></tr>";
//     });

//     const btnsAddParticipant=document.getElementsByName("addParticipant");
//     btnsAddParticipant.forEach(btn=>{
//         eventAddParticipant(btn);
//     })
    

// }