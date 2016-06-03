var mysql = require('mysql')

module.exports = function(router, connection) {


    router.route('/chat/:userIdChat/user/:userId')
        .get(function (req, res) {

            var userIdChat = req.params.userIdChat;
            var userId = req.params.userId;
            if(!userIdChat || !userId) {
                res.status(500).send({
                    success: false,
                    error: 'userIdChat and userId parameter is required'
                });

            } else {
                var request = "SELECT * FROM ChatsUsers cu, Users u WHERE (cu.user_id = ? AND cu.user_id_chat = ? AND u.id = cu.user_id) OR (cu.user_id = ? AND cu.user_id_chat =  ? AND u.id = cu.user_id)";
                var table = [userId, userIdChat, userIdChat, userId];
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

        .post(function (req, res) {

            var userIdChat = req.params.userIdChat;
            var userId = req.params.userId;
            var message = req.body.message;
            if(!userIdChat || !userId || !message) {
                res.status(500).send({
                    success: false,
                    error: 'userIdChat and userId parameter and message is required'
                });

            } else {
                var request = "INSERT INTO ChatsUsers (user_id, user_id_chat, message, date) VALUES (?, ?, ?, NOW())";
                var table = [userId, userIdChat, message];
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


    router.route('/chats/users/:userId')
        .get(function (req, res) {

            var userId = req.params.userId;
            if (!userId) {
                res.sttus(500).send({
                    success: false,
                    error: "userId parameter is required"
                });
            } else {

                var request = "SELECT * FROM ChatsUsers cu, Users u WHERE cu.user_id = ? AND cu.user_id_chat = u.id GROUP BY user_id_chat";
                var table = [userId];
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