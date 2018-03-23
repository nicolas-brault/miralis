(function () {
    "use strict";
    let erreurCritique = function () {
        $('body').html('Une erreur est survenue<br/>');
    };

    $(function() {
        let obj = JSON.parse('../players.json');
        for (var i in obj)
        {
            console.log(obj[i].playerID);
        }
    });

    QUnit.test("Standard usage", function (assert) {
        assert.log()
    });

})();