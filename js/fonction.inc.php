<script>
    function eventPers(per_num){
        window.location.href ="index.php?page=2&id=" + per_num;
    }


    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    function redirectionAccueil() {
        setTimeout(function(){window.location.href ="index.php?page=0"},2000);
    }

    function connect() {
        window.location.href ="index.php?page=9";
    }

    function disconnect() {
        window.location.href ="index.php?page=10";
    }

    function modifNote(vot_valeur, cit_num){
        var number = prompt("Quelle est la note de la citation selon vous ?", vot_valeur);

        var float = parseFloat(number);
        while (number === "" || isNaN(float) || float > 20 || float < 0) {
            number = prompt("Malheureusement, il nous faut un nombre en entre 0 et 20", number);
            float = parseFloat(number);
        }
        if (number === null){
            window.alert("L'ancienne valeur a été remise");
            window.location.href ="index.php?page=6";
        } else {
            window.alert("Les modifications ont bien été appliqués");
            window.location.href ="index.php?page=6&cit_num="+ cit_num + "&value=" + number;
        }
    }

    function noter( cit_num){
        var number = prompt("Quelle est la note de la citation selon vous ?", "");

        var float = parseFloat(number);
        while ((isNaN(float) || float > 20 || float < 0) && number !== null) {
            number = prompt("Malheureusement, il nous faut un nombre en entre 0 et 20", number);
            float = parseFloat(number);
        }
        if (number === null){
            window.alert("L'ancienne valeur a été remise");
            window.location.href ="index.php?page=6";
        } else {
            window.alert("Les modifications ont bien été appliqués");
            window.location.href ="index.php?page=6&cit_num="+ cit_num + "&value=" + number;
        }

    }

    function valider(cit_num) {
        window.location.href ="index.php?page=12&cit_num=" + cit_num + "&valid=0";
    }

    function invalider(cit_num) {
        window.location.href ="index.php?page=12&cit_num=" + cit_num + "&valid=1";
    }

    function modifierPers(per_num) {
        window.location.href ="index.php?page=3&per_num=" + per_num;
    }
    function supprimerVille(vil_num) {
        var bool = confirm("Attention supprimer la ville supprimera les étudiants et les citations en relation avec la ville !")
        if (bool){
            window.location.href ="index.php?page=15&vil_num=" + vil_num;
        }
        else {
            window.location.href ="index.php?page=15";
        }

    }
</script>