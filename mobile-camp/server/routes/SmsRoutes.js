var TMClient = require('textmagic-rest-client');

module.exports = function(router, connection) {


    router.route('/send/sms')
        .post(function (req, res) {

            var telephone = req.body.telephone;
            var login = req.body.login;
            var nom = req.body.nom;
            var prenom = req.body.prenom;
            if(!telephone || !login || !nom || !prenom) {
                res.status(500).send({
                    success: false,
                    error: 'telephone, login, nom and prenom parameter is required'
                });

            } else {

                var c = new TMClient('iliassmarchoud', 'SXZvZuPSRCs6oEFqIQEyGxNTM7oUvz');
                c.Messages.send({text: 'Salut ! '+prenom+' '+nom+' souhaite faire un groupe avec toi ! ---- Message envoyé depuis ETNA Tinder ---- ', phones:telephone}, function(err, data){
                    if (err) {
                        res.status(500).send({
                            success: false,
                            error: err
                        });
                    } else {
                        res.status(200).send({
                            success: true,
                            data: data
                        });
                    }
                });
            }

        })

}