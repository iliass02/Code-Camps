var mysql = require("mysql");

module.exports = function(router, connection) {

    router.route('/wishlist/:userId')
        .post(function (req, res) {

            var userId = req.params.userId;
            var userLikeId = req.body.userLikeId;

            if (!userId || !userLikeId) {
               res.status(500).send({
                   success: false,
                   error: "userId parameter and userLikeId are required"
               })
            } else {

                var request = "SELECT * FROM WishList WHERE user_id = ? AND user_like_id = ?";
                var table = [userId, userLikeId];
                request = mysql.format(request, table);
                connection.query(request, function (err, data) {

                    if (err) {
                        res.status(500).send({
                            success: false,
                            error: err
                        });
                    } else {

                        if (data.length == 0) {
                            var request = "INSERT INTO WishList (??, ??) VALUES (?, ?)";
                            var table = ['user_id', 'user_like_id', userId, userLikeId];
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
                        } else {

                            //statsu 200 pour que l'utilisateur ai la possibilité de continuer à like ou dislike
                            res.status(200).send({
                                success: false,
                                error: "User already exists in your Wishlist "
                            });

                        }

                    }

                });

            }
        })

        .get(function (req, res) {

            var userId = req.params.userId;
            if (!userId) {
                res.status(500).send({
                    success: false,
                    error: "userId parameter is required"
                })
            } else {

                var request = "SELECT * FROM Users as u, WishList as wl WHERE wl.user_id = ? AND wl.user_like_id = u.id";
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

        .delete(function (req, res) {

            var userLikeId = req.params.userId;
            var userId = req.query.userId;
            if (!userLikeId || !userId) {
                res.status(500).send({
                    success: false,
                    error: "userIdLike parameter and userId is required"
                })
            } else {

                var request = "DELETE FROM WishList WHERE user_like_id = ? AND user_id = ?";
                var table = [userLikeId, userId];
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

        });

}