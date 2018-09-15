var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  var workExperience = require('../data/work-experience.js');
  console.log(workExperience);
  res.render('index', {
    title: 'Nate Kerksick',
    workExperience
  });
});

module.exports = router;
