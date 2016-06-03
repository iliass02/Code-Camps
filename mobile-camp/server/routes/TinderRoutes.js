var mysql = require("mysql");
var bcrypt = require("bcrypt-nodejs");

module.exports = function(router, connection) {

    router.route('/info/user/:userId/term/:term/userTinder/:userTinderId')
        .get(function (req, res) {

            var userTinderId = req.params.userTinderId;
            var userId = req.params.userId;
            var term = req.params.term;
            if (!userId || !userTinderId || !term) {
                res.status(500).send({
                    success: false,
                    error: "userTinderId, userId and term parameters are required"
                });
            } else if (userId == userTinderId) {
                res.status(400).send({
                    success: false,
                    error: "userId and userTinderId are equals !"
                });
            } else {

                var request = "SELECT * FROM Users WHERE id = ? AND terms = ?";
                var table = [userTinderId, term];
                request = mysql.format(request, table);
                connection.query(request, function (err, data) {

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

                })

            }

        })

}