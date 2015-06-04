(function(){
  'use strict';
  var notas={};
  var module = angular.module('app', ['onsen']);

  module.controller('AppController', function($scope, $data) {
    $scope.doSomething = function() {
      setTimeout(function() {
        alert(''+device.uuid);
      }, 100);
    };
  });

  module.controller('DetailController', function($scope, $data) {
    $scope.item = $data.selectedItem;
    //navigator.notification.vibrate(2000); //milliseconds
	//navigator.notification.beep(2); // numbr of times
  });

  module.controller('MasterController', function($scope, $data, $http) {
    $scope.items = notas;  
    $http.get('http://www.empowerlabs.com/intellibanks/data/Sandbox/GemaValdez/Lectura.php').
  success(function(data, status, headers, config) {
  	data.reverse();
    $data.items=data;
    notas=data;
    $scope.items = $data.items;  
    $scope.showDetail = function(item) {
      var selectedItem = item;
      $data.selectedItem = selectedItem;
      $scope.ons.navigator.pushPage('detail.html', {title : selectedItem.title});
    };
  }).
  error(function(data, status, headers, config) {
  	
  });
  });

  module.factory('$data', function() {
      var data = {};
      
      data.items = notas;
      
      return data;
  });
})();

