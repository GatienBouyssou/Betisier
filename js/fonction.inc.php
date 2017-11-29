<script>
    function eventPers(){
        var numPers = document.getElementsByClassName("listPers");
        for (var i = 0; i < numPers.length; i++) {
            numPers[i].addEventListener("click",(event) => {
                var id = event.target.value;
            window.location.replace("http://localhost/BetisierEtu/index.php?page=2&id=" + id);
        }, false);
        }
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    function redirectionAccueil() {
        setTimeout(function(){window.location.replace("http://localhost/BetisierEtu/index.php?page=0")},2000);
    }

    function connect() {
        window.location.replace("http://localhost/BetisierEtu/index.php?page=9");
    }

    function disconnect() {
        window.location.replace("http://localhost/BetisierEtu/index.php?page=10");
    }
</script>