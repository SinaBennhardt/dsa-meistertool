function RandomBirthday() {
    let day = Math.floor((Math.random() * 30) + 1);

    let monthChoice = ["Praios", "Rondra", "Efferd", "Travia", "Boron", "Hesinde",
        "Firun", "Tsa", "Phex", "Peraine", "Ingerimm", "Rahja"];


    if (day <= 5) {
        monthChoice.push("Namenloser");
    }

    let monthNumber = Math.floor(Math.random() * monthChoice.length);

    let month = monthChoice[monthNumber];
    document.getElementById("Day").value = day;
    document.getElementById("Month").value = month;
}

function DisplayAsP() {
    let checkBox = document.getElementById("IfMagic");
    let AsPLabel = document.getElementById("AsP-label");

    if (checkBox.checked === true) {
        AsPLabel.style.display = "block";
    } else {
        AsPLabel.style.display = "none";
    }
}

function DisplayKP() {
    let checkBox = document.getElementById("IfHoly");
    let KPLabel = document.getElementById("KP-label");

    if (checkBox.checked === true) {
        KPLabel.style.display = "block";
    } else {
        KPLabel.style.display = "none";
    }

}

let MU, KL, IN, CH, FF, GE, KO, KK;

function update() {
    MU = +document.getElementById("MU").value;
    KL = +document.getElementById("KL").value;
    IN = +document.getElementById("IN").value;
    CH = +document.getElementById("CH").value;
    FF = +document.getElementById("FF").value;
    GE = +document.getElementById("GE").value;
    KO = +document.getElementById("KO").value;
    KK = +document.getElementById("KK").value;

    CalculateHP();
    CalculateAusD();
    CalculateAsP();
    CalculateMR();
    CalculateINI();
    CalculateAT();
    CalculatePA();
    CalculateFK();
}

function CalculateHP() {
    let HP = Math.round(((KO + KO + KK) / 2) + 10);
    document.getElementById("LeP").value = HP;
}

function CalculateAusD() {
    let AusD = Math.round(((MU + KO + GE) / 2) + 10);
    document.getElementById("AusD").value = AusD;
}

function CalculateAsP() {
    let AsP = Math.round(((MU + IN + CH) / 2) + 10);
    document.getElementById("AsP").value = AsP;
}

function CalculateMR() {
    let MR = Math.round(((MU + KL + KO) / 5) - 4);
    document.getElementById("MR").value = MR;
}

function CalculateINI() {
    let INI = Math.round((MU + MU + IN + GE) / 5);
    document.getElementById("INI-Basis").value = INI;
}

function CalculateAT() {
    let AT = Math.round((MU + GE + KK) / 5);
    document.getElementById("AT").value = AT;
}

function CalculatePA() {
    let PA = Math.round((IN + GE + KK) / 5);
    document.getElementById("PA").value = PA;
}

function CalculateFK() {
    let FK = Math.round((IN + FF + KK) / 5);
    document.getElementById("FK").value = FK;

}

function SaveContent() {
    let form = document.getElementById("Form");
    let data = {};

    for (let i = 0; i < form.elements.length; i++) {
        let element = form.elements[i];

        if (element.dataset.save === "true") {
            data[element.id] = element.value;

        }
    }
    /* let allData = {
         "Name": document.getElementById("Charactername").value,
         "Rasse": document.getElementById("Race").value,
         "Kultur": document.getElementById("Culture").value,
         "Profession": document.getElementById("Profession").value,
         "Geschlecht": document.getElementById("Sex").value,
         "Geburtstag": document.getElementById("Day").value,
         "Geburtsmonat": document.getElementById("Month").value,
         "Alter": document.getElementById("Age").value,
         "Gewicht": document.getElementById("Weight").value,
         "Haarfarbe": document.getElementById("HairColor").value,
         "Augenfarbe": document.getElementById("EyeColor").value,
         "Titel": document.getElementById("Title").value,
         "SozialStatus": document.getElementById("SocialStatus").value,
         "MU": document.getElementById("MU").value,
         "KL": document.getElementById("KL").value,
         "IN": document.getElementById("IN").value,
         "CH": document.getElementById("CH").value,
         "FF": document.getElementById("FF").value,
         "GE": document.getElementById("GE").value,
         "KO": document.getElementById("KO").value,
         "KK": document.getElementById("KK").value
     };*/
    let allDataJSON = JSON.stringify(data);
    localStorage.setItem("AllData", allDataJSON);
}

function LoadContent() {
    let reloadAllDataJSON = localStorage.getItem("AllData");

    if (reloadAllDataJSON === null) {
        alert("Du hast keine Daten gespeichert.")
    } else {
        let reloadData = JSON.parse(reloadAllDataJSON);
        let form = document.getElementById("Form");

        for (let i = 0; i < form.elements.length; i++) {
            let element = form.elements[i];

            if (element.dataset.save === "true") {
                element.value = reloadData[element.id];
            }

        }


        /*document.getElementById("Charactername").value = reloadData.Name;
        document.getElementById("Race").value = reloadData.Rasse;
        document.getElementById("Culture").value = reloadData.Kultur;
        document.getElementById("Profession").value = reloadData.Profession;
        document.getElementById("Sex").value = reloadData.Geschlecht;
        document.getElementById("Day").value = reloadData.Geburtstag;
        document.getElementById("Month").value = reloadData.Geburtsmonat;
        document.getElementById("Age").value = reloadData.Alter;
        document.getElementById("Weight").value = reloadData.Gewicht;
        document.getElementById("HairColor").value = reloadData.Haarfarbe;
        document.getElementById("EyeColor").value = reloadData.Augenfarbe;
        document.getElementById("Title").value = reloadData.Titel;
        document.getElementById("SocialStatus").value = reloadData.SozialStatus;
        document.getElementById("MU").value = reloadData.MU;
        document.getElementById("KL").value = reloadData.KL;
        document.getElementById("IN").value = reloadData.IN;
        document.getElementById("CH").value = reloadData.CH;
        document.getElementById("FF").value = reloadData.FF;
        document.getElementById("GE").value = reloadData.GE;
        document.getElementById("KO").value = reloadData.KO;
        document.getElementById("KK").value = reloadData.KK;*/

        update();
    }
}

function ClearLocalStorage() {
    let clearLocalStorage = confirm("Möchtest du deinen alten Speicher wirklich löschen?");
    if (clearLocalStorage === true) {
        localStorage.clear();
        alert("Deine gespeicherten Daten wurden gelöscht.");
    } else {
    }

}

