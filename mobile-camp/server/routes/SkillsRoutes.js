var mysql = require("mysql");
var bcrypt = require("bcrypt-nodejs");

module.exports = function(router, connection) {


    router.route("/skills/user/:userId")
        .get(function (req, res) {

            var userId = req.params.userId;
            if (!userId) {
                res.status(500).send({
                   success: false,
                    error: "userId parameter is required"
                });
            } else {

                var request = "SELECT s.nom as nom FROM SkillsUsers su, Skills s WHERE s.id = su.skill_id AND su.user_id = ? AND su.amelioration = 0";
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

                });

            }

        });

    router.route("/skills-improve/user/:userId")
        .get(function (req, res) {

            var userId = req.params.userId;
            if (!userId) {
                res.status(500).send({
                    success: false,
                    error: "userId parameter is required"
                });
            } else {

                var request = "SELECT s.nom as nom FROM SkillsUsers su, Skills s WHERE s.id = su.skill_id AND su.user_id = ? AND su.amelioration = 1";
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

                });

            }

        });

    //get all skills
    router.route("/skills")
        .get(function (req, res) {

            var request = "SELECT * FROM Skills";
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

        })

    router.route("/skills/:userId")
        .post(function (req, res) {

            var userId = req.params.userId;
            var skillsId = req.body.skillsId;

            if (!skillsId || !skillsId || skillsId.length == 0) {
                res.status(400).send({
                    success: false,
                    error: "userId parameter is required"
                });
            } else {
                for (var i = 0; i < skillsId.length; i++) {

                    var request = "INSERT INTO SkillsUsers (user_id, skill_id) VALUES (?, ?)";
                    var table = [userId, skillsId[i]];
                    request = mysql.format(request, table);
                    connection.query(request, function (err, data) {

/*                        if (err) {
                            res.status(500).send({
                                success: false,
                                error: err
                            });
                        }*/

                    });

                }
                res.status(200).send({
                    "success": true
                });
            }


        })

    router.route("/skills-improve/:userId")
        .post(function (req, res) {

            var userId = req.params.userId;
            var skillsId = req.body.skillsId;

            if (!skillsId || !skillsId || skillsId.length == 0) {
                res.status(400).send({
                    success: false,
                    error: "userId parameter is required"
                });
            } else {
                for (var i = 0; i < skillsId.length; i++) {

                    var request = "INSERT INTO SkillsUsers (user_id, skill_id, amelioration) VALUES (?, ?, 1)";
                    var table = [userId, skillsId[i]];
                    request = mysql.format(request, table);
                    connection.query(request, function (err, data) {

                        /*                        if (err) {
                         res.status(500).send({
                         success: false,
                         error: err
                         });
                         }*/

                    });

                }
                res.status(200).send({
                    "success": true
                });
            }


        })

    router.route("/skills/search/:skills")
    .get(function (req, res) {
        var skills = req.params.skills;
        var promo = req.query.promo;
        var promo2 = req.query.promo;

        if (!skills || !promo) {
        res.status(500).send({
            success:false,
            error:"Skills & promo parameters are required"
            })
        }
        else {
         var request = "SELECT u.nom, u.prenom, u.terms, su.skill_id, su.user_id, su.amelioration, s.nom as competences, u.login FROM Users u, SkillsUsers su, Skills s WHERE s.nom LIKE '%"+skills+"%' AND s.id = su.skill_id AND su.user_id = u.id AND u.terms = ? OR u.login LIKE '%"+skills+"%' AND s.id = su.skill_id AND su.user_id = u.id AND u.terms = ? GROUP BY u.login";
            var table = [promo, promo2];

            request = mysql.format(request, table);

            connection.query(request, function(err, data) {
            if (err) {
                res.status(500).send({
                    success:false,
                    error:err
                    })
            }
            else {
                res.status(200).send({
                    success:true,
                    data:data
                    })
                }
            })
        }
    })

    router.route("/skill/recommandation/:userId")
    .post(function (req, res) {
        var userId = req.params.userId;
        var skillsId = req.query.skillsId;
        var user_reco_id = req.query.userCo;
        console.log(userId, skillsId)

        if (!userId || !skillsId) {

            res.status(500).send({
                success:false,
                error:"Skills & user_id parameters are required"
                })
            }
        else {
            var request = "INSERT INTO SkillsRecommandation (user_id, skill_id, user_reco_id) VALUES (?, ?, ?)";
            var table = [userId, skillsId, user_reco_id];
            request = mysql.format(request, table);
            connection.query(request, function (err, data) {
            if (err) {
                res.status(500).send({
                success: false,
                error: err
                });
            }
            else {
                res.status(200).send({
                    "success": true
                });
            }
        })
        }

    });

    router.route("/skill/recommandation/verif/:userId")
    .get(function (req, res) {
        var skill_id = req.query.skillId;
        var user_id = req.params.userId;

        if (!skill_id || !user_id) {
         res.status(500).send({
            success:false,
            error:"Skills & user_id parameters are required"
            })
        }
        else {
            var request = "SELECT * FROM SkillsRecommandation WHERE skill_id = ? AND user_reco_id = ?";
            var table = [skill_id, user_id];
            request = mysql.format(request,table)
            console.log(request);
            connection.query(request, function (err, data) {
                if (err) {
                    res.status(500).send({
                        success: false,
                        error: err
                    });
                }
                else {
                    res.status(200).send({
                        "success": true,
                        data:data
                    });
                }
            })
        }
    })
 
    router.route("/skill/recommandation/count/:userId/:improve")
    .get(function (req, res) {
        var user_id = req.params.userId;
        var improve = req.params.improve;

        if (!user_id) {
            res.status(500).send({
            success:false,
            error:"user_id parameters are required"
            })
        }
        else {
            var request = "SELECT COUNT(sr.id) AS count_skill, s.nom, su.user_id, s.id AS skill_id FROM Users u INNER JOIN SkillsUsers su ON u.id = su.user_id INNER JOIN Skills s ON su.skill_id = s.id LEFT JOIN SkillsRecommandation sr ON su.skill_id = sr.skill_id WHERE u.id = ? AND su.amelioration = ? GROUP BY su.skill_id";
            var table = [user_id, improve];
            request = mysql.format(request,table)
            console.log(request);
            connection.query(request, function(err, data) {
                if (err) {
                    res.status(500).send({
                        success: false,
                        error: err
                    });
                }
                else {
                    res.status(200).send({
                        "success": true,
                        data:data
                    });
                }
            })
        }

    })
}