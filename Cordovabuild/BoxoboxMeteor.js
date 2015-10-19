
if (Meteor.isClient) {

  Template.weather.helpers({
    meteo: function () {
      return Session.get('meteo');
    }
  });

  Template.weather.events({
    'click button': function () {
      Session.set('meteo', 'Loading...')
      Meteor.call('getmeteo', function(error, result){
        if(error){
          alert("dmg...");
        }
        else{
          Session.set('meteo', result+"°C");
        }
      });
    }
  });

  Template.intro.events({
    'click a[target=_blank]': function (event) {
      event.preventDefault();
      window.open(event.target.href, '_blank');
    }
  });

  Template.message.events({

    'submit form': function(event){
        event.preventDefault();
        var text = event.target.text.value;
        console.log(text);

        Meteor.call('sendmess',text, function(error, result){
          if(error){
            alert("Error : \n Utilisez que des majuscules 2");
          }
          else{
            alert("Message Envoyé : \n " + result);
          }
        });
    }
  });

}





if (Meteor.isServer) {

  Meteor.startup(function () {
    // code to run on server at startup
  });

  Meteor.methods({
    getmeteo: function () { 
      console.log("hello meteo");
      url = 'http://boxobox.ddns.net/android.php/?hi=t';
      try {
        var result = HTTP.call("GET", url);
        console.log(result.content);
        return result.content;
      } catch (e) {
        return "oupsi";
      }
    }
  });

  Meteor.methods({
    sendmess: function (text) { 
      console.log("hello text");
      url = 'http://boxobox.ddns.net/android.php/?hi=' + text;
      try {
        var result = HTTP.call("GET", url);
        console.log(result.content);
        return result.content;
      } catch (e) {
        return "Error : \n Utilisez que des majuscules 1";
      }
    }
  });
}
