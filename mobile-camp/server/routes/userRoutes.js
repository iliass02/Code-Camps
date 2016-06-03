var mysql = require("mysql");
var bcrypt = require("bcrypt-nodejs");


module.exports = function(router, connection) {

    router.route("/signup")
        // get all clients
        .post(function(req, res) {

            var nom = req.body.nom;
            var prenom = req.body.prenom;
            var login = req.body.login;
            var mdp = req.body.mdp;
            var terms = req.body.terms;
            var telephone = req.body.telephone


            if (!nom || !prenom || !login || !mdp || !terms || !telephone) {
                 return res.status(500).send({
                    "success": false,
                    "error": "nom, prenom, login, mdp, promo and telephone are required"
                });
            }
            
            mdp = bcrypt.hashSync(mdp);


            var request = "SELECT * FROM ?? WHERE ?? = ? OR (?? = ? AND ?? = ?)";
            var table = ['Users', 'login', login, 'nom', nom, 'prenom', prenom, ];
            request = mysql.format(request, table);
            connection.query(request, function(err, data) {
                if (err) {
                    res.status(500).send({
                        "success": false,
                        "error": err
                    });
                } else {

                    if (data.length == 0) {
                        var request = "INSERT INTO ?? (??, ??, ??, ??, ??, ??, ??, color) VALUES (?, ?, ?, ?, ?, NOW(), ?, 'teal lighten-2')";
                        var table = ['Users', 'nom', 'prenom', 'login', 'mdp', 'terms', 'date_inscription', 'telephone', nom, prenom, login, mdp, terms, telephone];
                        request = mysql.format(request, table);
                        connection.query(request, function(err, data) {
                            if (err) {
                                res.status(500).send({
                                    "success": false,
                                    "error": err
                                });
                            }
                            else {
                                res.status(200).send({
                                    "success": true,
                                    "data": data
                                });
                            }
                        });
                    } else {
                        res.status(401).send({
                            "success": false,
                            "error": "User exists"
                        });
                    }
                }
            });

        });


    router.route("/signin")

        .post(function(req, res) {

            var login = req.body.login;
            var mdp = req.body.mdp;

            if (!login || !mdp) {
                return res.status(500).send({
                    "success": false,
                    "error": "login and mdp are required"
                });
            }


            var request = "SELECT * FROM ?? WHERE ?? = ?";
            var table = ['Users', 'login', login ];
            request = mysql.format(request, table);
            connection.query(request, function(err, data) {
                if (err) {
                    res.status(500).send({
                        "success": false,
                        "error": err
                    });
                } else {

                    if (data.length == 1) {

                        if(bcrypt.compareSync(mdp, data[0].mdp)) {
                            res.status(200).send({
                                "success": true,
                                "data": data
                            });
                        } else {
                            res.status(400).send({
                                "success": false,
                                "error": "Password is incorrect"
                            });
                        }

                    } else {
                        res.status(401).send({
                            "success": false,
                            "error": "User inexists"
                        });
                    }

                }
            });

        });


    router.route("/terms")


        .get(function(req, res) {


            var requestTerms = "SELECT terms_id, nom_terms, promo FROM Terms";

            connection.query(requestTerms, function(err, data) {

                if (err) {
                    res.status(500).send({
                        "success": false,
                        "error": err
                    });
                } else {
                    res.status(200).send({
                        "success": true,
                        "data": data
                    });
                }
            });

        });



    router.route("/account/:userId")
        // GET to retireve user info / skills
        .get(function(req, res) {

            var userId = req.params.userId;

            if (!userId) return res.status(500).send({
                success : false,
                error : "User id is requiered !"});

            else {

                var queryInfoUser = "SELECT t.terms_id, t.nom_terms, t.promo, u.id, u.nom, u.prenom, u.login, u.telephone FROM Users u, Terms t WHERE u.id = ? AND u.terms = t.terms_id"
                var table = [userId];

                queryInfoUser = mysql.format(queryInfoUser, table);
                connection.query(queryInfoUser, function(err, userInfo) {

                    if (err) {
                        res.status(500).send({
                            "success": false,
                            "error": err
                        });
                    } else {
                        if (userInfo.length != 0) {

                            var querySkillsM = "SELECT su.id AS skillUserId, s.id, s.nom, su.amelioration FROM Users u INNER JOIN SkillsUsers su ON u.id = su.user_id INNER JOIN Skills s ON su.skill_id = s.id WHERE u.id = ? AND su.amelioration = 0"

                            querySkillsM = mysql.format(querySkillsM, table);
                            connection.query(querySkillsM, function(err, userSkillsM) {

                                if (err) {
                                    res.status(500).send({
                                        "success": false,
                                        "error": err
                                    });
                                } else {

                                    var querySkills = "SELECT su.id AS skillUserId, s.id, s.nom, su.amelioration FROM Users u INNER JOIN SkillsUsers su ON u.id = su.user_id INNER JOIN Skills s ON su.skill_id = s.id WHERE u.id = ? AND su.amelioration = 1"

                                    querySkills = mysql.format(querySkills, table);
                                    connection.query(querySkills, function(err, userSkills) {

                                        if (err) {
                                            res.status(500).send({
                                                "success": false,
                                                "error": err
                                            });
                                        } else {

                                            res.status(200).send({
                                                "success": true,
                                                "userInfo": userInfo,
                                                "userSkillsM": userSkillsM,
                                                "userSkills": userSkills
                                            });
                                        }
                                    });
                                }
                            });
                        } else {
                              res.status(401).send({
                                  "success": false,
                                  "error": "User not found !"
                              });
                          }
                        }
                    });

                }
        });

    router.route("/account/delSkill")
        .delete(function(req, res) {
            var idSkillUser = req.query.skillId;

            if(!idSkillUser) {
                res.status(500).send({
                    "success": false,
                    "error": "skillId is required"
                });
            }

            var queryDelSKill = "DELETE FROM SkillsUsers WHERE id = ?"
            var table = [idSkillUser];

            queryDelSKill = mysql.format(queryDelSKill, table);
            connection.query(queryDelSKill, function(err, delIt) {
                if (err) {
                    res.status(500).send({
                        "success": false,
                        "error": err
                    });
                } else {
                    res.status(200).send({
                        "success": true,
                        "delIt": delIt
                    });
                }
            });

        });

    router.route('/users')
        .get(function (req, res) {

            var request = "SELECT * FROM Users";
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

    router.route('/user/promo/:promo')
        .get(function (req, res) {

            var promo = req.params.promo;

            if (!promo) {
                res.status(500).send({
                    success:false,
                    error:"Promo parameter is required"
                })
            }
            else {
                var request = "SELECT * FROM Users WHERE promo = ?";
                var table = [promo];

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

    // Change status of user skill
    router.route("/skills-status/")
        .post(function (req, res) {
            var userId = req.body.userId;
            var skillsId = req.body.skillsId;
            var status = req.body.status;

            console.log(userId, skillsId, status);

            if (!userId || !skillsId) {
                return res.status(500).send({
                    success: false,
                    error: [userId, skillsId, status]
                });
            } else {

                for (i = 0; i < skillsId.length; i++) {
                    var query = "UPDATE SkillsUsers SET amelioration = ? WHERE skill_id = ? AND user_id = ?"
                    var param = [status, skillsId[i], userId];

                    query = mysql.format(query, param);
                    connection.query(query, function (err, data) {
                        /*if (err) {
                         res.status(500).send({
                         "success": false,
                         "error": err
                         });
                         }*/
                    })
                }
                res.status(200).send({
                    "success": true
                });
            }
        });
    
    router.route('/users/search')
        .get(function (req, res) {


            var searchValue = req.query.recherche;
            var termValue = req.query.term;

            var request = "SELECT * FROM Users WHERE login LIKE '%"+searchValue+"%' AND terms="+termValue;

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


    router.route('/user/login/:login')
        .get(function (req, res) {

            var login = req.params.login;
            if (!login) {
                res.status(500).send({
                    success: false,
                    error: "login is required"
                });
            } else {


                var request = "SELECT * FROM Users WHERE login = ?";
                var table = [login];
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
                        })
                    }

                })
            }
            
        });

    // COLOR

    router.route('/user/color/:login')
        .get(function (req, res) {

            var login = req.params.login;
            if (!login) {
                res.status(500).send({
                    success: false,
                    error: "login is required"
                });
            } else {


                var request = "SELECT color FROM Users WHERE login = ?";
                var table = [login];
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
                        })
                    }

                })
            }

        });


    router.route('/user/updateColor/:login/:colorName')
        .get(function (req, res) {

            console.log("sisi")

            var newColor = req.params.colorName;

            var login = req.params.login;

            if (!login) {
                res.status(500).send({
                    success: false,
                    error: "login is required"
                });
            } else {


                var request = "UPDATE Users SET color = ? WHERE login = ?";
                var table = [newColor, login];
                request = mysql.format(request, table);
                console.log(request);
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
                        })
                    }

                })
            }

        });
}