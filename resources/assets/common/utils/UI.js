let UI = {
  api_version: '0.0.1',
  Yuser: null,
  pageParams: {},
  singPack: {},
  isGuest (){
    return !UI.Yuser || !UI.Yuser.id;
  },
  setYuser (user){
    this.Yuser = user;
  },
  ...window.UI,
  date: {
    ago: function(t){
      t = t ? new Date(t) : new Date();
      let diff = (((new Date()).getTime() - t.getTime()) / 1000);
      diff = diff > 0 ? diff : 0;
      let day_diff = Math.floor(diff / 86400);

      return day_diff === 0 &&
        (
          diff < 60 && "just now" ||
          diff < 120 && "1 minute ago" ||
          diff < 3600 && Math.floor( diff / 60 ) + "minutes ago" ||
          diff < 7200 && "1 hour ago" ||
          diff < 86400 && Math.floor( diff / 3600 ) + " hours ago"
        ) ||
        day_diff === 1 && "Yesterday" ||
        day_diff < 7 && day_diff + " days ago" ||
        Math.ceil( day_diff / 7 ) + " weeks ago";
    },

    currentDate: function(t){
        let monthNamesLong = [
          "January", "February", "March",
          "April", "May", "June", "July",
          "August", "September", "October",
          "November", "December"
        ];
        let monthNamesShort = [
          "Jan", "Feb", "Mar",
          "Apr", "May", "June", "July",
          "Aug", "Sep", "Oct",
          "Nov", "Dec"
        ];

        let date = t ? new Date(t) : new Date();
        let day = date.getDate();
        let monthIndex = date.getMonth();
        let year = date.getFullYear();
        return day + ' ' + monthNamesShort[monthIndex] + ', ' + year;
      },

    chatTime: function(t){
      t = new Date(t);
      let day = t.getDate();
      let month = t.getMonth()+1;
      let year = t.getFullYear();
      let hour = t.getHours();
      let min = t.getMinutes();
      let sec = t.getSeconds();

      return year +'-'+ month +'-'+ day +' '+ hour +':'+ min +':'+ sec;
    },

    simple: function(t){
      t = new Date(t);
      let day = t.getDate(); day = day<10 ? "0"+day : day;
      let month = t.getMonth()+1; month = month<10 ? "0"+month : month;
      let year = t.getFullYear();
      let hour = t.getHours(); hour = hour<10 ? "0"+hour : hour;
      let min = t.getMinutes(); min = min<10 ? "0"+min : min;

      return year +'-'+ month +'-'+ day + " " + hour + ":" + min;
    }
  },

};

export default UI;