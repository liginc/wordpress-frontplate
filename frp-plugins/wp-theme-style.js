'use strict';
const fs = require('fs-extra');
const Rx = require('rxjs');
const ejs = require('ejs');

module.exports = function (argv, config) {
  const filePath = './frp-plugins/style.css';
  const outputPath = `${config.wp.dest}/style.css`;

  return Rx.Observable.create((observer) => {

    ejs.renderFile(filePath, config.wp.params, (err, str) => {
      if(err) return observer.error(err);

      fs.outputFile(outputPath, str, (err) => {
        if(err) observer.error(err);
        observer.next(outputPath);
      });
    });

  });
};
