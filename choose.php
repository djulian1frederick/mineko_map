<form id="gitAddress">
        <input type="hidden" id="gitCode" value="" readonly="readonly" />
        <input type="hidden" id="gitPost" value="" readonly="readonly" />
      </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      var base = "https://GitDataOrg.github.io/AddressRU/data/";
      var socrbase = {};
      function gitData(code, index, callback){
        $.ajax({
          type: "GET",
          url: base + code + ".json",
          dataType: "json",
          success: function(data) {
            if (code == "socrbase") {
              socrbase = data;
              if (callback) callback();
            } else {
              data.sort(sortObject);
              var selectList = document.createElement("select");
              selectList.attributes["code"] = code == "00" ? "" : code;
              selectList.attributes["index"] = index;
              selectList.appendChild(document.createElement("option"));
              for (i=0,c=data.length; i<c; ++i) {
                item = data[i];
                var option = document.createElement("option");
                name = item[1];
                if (socrbase[item[2]]) name += " " + socrbase[item[2]];
                option.value = item[0];
                option.text = name;
                option.attributes["postcode"] = item[3] || "";
                selectList.appendChild(option);
              };

              document.getElementById("gitAddress").appendChild(selectList);
              selectList.onchange = function(){onSelect(this);};
              if (callback) callback();
            }
          },
          error: function(err){
            console.log("Error:", err);
          },
        });
      };
      function sortObject(a, b){
        return (a[1] < b[1]) ? -1 : 1;
      };
      function onSelect(obj) {
        var index = obj.attributes["index"] || 0;
        var code = obj.attributes["code"] + obj.value;
        var div = document.getElementById("gitAddress");
        var elems = div.getElementsByTagName("select");
        for (i=0,c=elems.length; i<c; ++i) {
          var elem = elems[i];
           if (elem.attributes["index"] > index) {
            div.removeChild(elem);
          }
        };
        document.getElementById("gitCode").value = code;
        document.getElementById("gitPost").value = obj.options[obj.selectedIndex].attributes["postcode"];
        gitData(code, index + 1);
      };
      gitData("socrbase", 0, gitData("00"));
    </script>
  