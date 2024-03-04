var rowEditing = false;

// Print Users
print_users();
function print_users() {
  $(document).ready(function () {
    get_users_all();
    function get_users_all() {
      $.ajax({
        url: "../services/data_storage_proxy/fetch_users.php",
        method: "GET",
        success: function (data) {
          // alert(data);
          $("#user-data").html(data);
          // console.log(data);
        },
      });
    }
  });
}

// delete Button // reject Button
$(document).on("click", ".delete-btn, .reject-btn", function () {
  let answer = confirm("Are you sure?");
  console.log(answer);
  if (answer) {
    var tr = $(this).closest("tr");
    var btn_div = $(this).closest("div");
    var del_id = btn_div.attr("id");
    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/delete_user.php",
      datatype: "json",
      data: { del_id: del_id },
      success: function (response) {
        if (response == 0) {
          // remove from table
          tr.fadeOut(150, function () {
            tr.remove();
          });
        } else alert(response);
      },
      error: function () {
        alert("Problem deleting this item");
      },
    });
  }
});

// approve Button
$(document).on("click", ".approve-btn", function (event) {
  var target = $(event.target).closest("div");
  user_id = target.attr("id");
  data = { id: user_id };

  $.ajax({
    url: "../services/data_storage_proxy/confirm_user.php",
    method: "POST",
    datatype: "json",
    data: data,
    success: function (response) {
      obj = JSON.parse(response);
      console.log(obj.message);
      // when confirmed change the buttons for the user
      print_users();
    },
    error: function (response) {
      console.log(response);
    },
  });
});

var idChanging;
// change visible btns
let change_btns = function (a) {
  var id = $(a).attr("id");
  if (!rowEditing || (rowEditing && idChanging == id)) {
    $("#" + id + ".edit-btn").toggleClass("invisible");
    $("#" + id + ".reject-btn-edit").toggleClass("invisible");
    $("#" + id + ".save-btn").toggleClass("invisible");
  }
};

const prevData = [];

// Handle edit button pressed
$(document).ready(function () {
  $(document).on("click", ".edit-btn", function () {
    if (!rowEditing) {
      rowEditing = true;
      var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
      var role = $(this).closest("tr").find(".role");
      var rolespan = $(this).closest("tr").find(".role-span");
      var roleselect = $(this).closest("tr").find(".role-select");
      idChanging = $(tr[0]).html();

      // store data before change
      for (let i = 0; i < tr.length; i++) {
        prevData[i] = $(tr[i]).html();
      }
      tr.attr("contenteditable", "true");
      // Role'
      role.attr("contenteditable", "false");
      rolespan.attr("hidden", true);
      roleselect.attr("hidden", false);
    } else {
      alert("Another row is being edited currently");
    }
  });
});

// if reject edit is pressed stop editing, return to prior state
$(document).ready(function () {
  $(document).on("click", ".reject-btn-edit", function () {
    rowEditing = false;
    // cancel editable
    var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
    tr.attr("contenteditable", "false");

    for (let i = 0; i < prevData.length; i++) {
      $(tr[i]).html(prevData[i]);
    }
  });
});

var opted;
function getSelected(selTag) {
  opted = selTag.options[selTag.selectedIndex].text;
}

// Handle save button pressed
$(document).ready(function () {
  $(document).on("click", ".save-btn", function () {
    rowEditing = false;
    var tr = $(this).closest("tr").find("td").not(":last-child .role");

    var rolespan = $(this).closest("tr").find(".role-span");
    $("#box1 option:selected").text();
    var roleselect = $(this).closest("tr").find(".role-select");
    roleselect.attr("hidden", true);

    if (opted == null || opted == "Select Role") {
      role = rolespan.text();
    } else {
      role = opted;
    }
    rolespan.text(role);
    rolespan.attr("hidden", false);
    tr.attr("contenteditable", "false");
    var tr = $(this).closest("tr");
    var i = 0;
    var cols = new Array(6);
    $(tr)
      .find("td")
      .each(function () {
        cols[i] = $(this).text();
        i += 1;
      });
    var update_id = $(this).attr("id");

    data = {
      update_id: update_id,
      username: cols[1],
      email: cols[2],
      role: role,
      description: cols[4],
      website: cols[5],
    };

    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/edit_user.php",
      datatype: "json",
      data: data,
      success: function (response) {
        obj = JSON.parse(response);
        console.log(obj.message);
        // when confirmed change the buttons for the user
        print_users();
      },
      error: function (jqXHR, exception) {
        var msg = "";
        if (jqXHR.status === 0) {
          msg = "Not connect.\n Verify Network.";
        } else if (jqXHR.status == 404) {
          msg = "Requested page not found. [404]";
        } else if (jqXHR.status == 500) {
          msg = "Internal Server Error [500].";
        } else if (exception === "parsererror") {
          msg = "Requested JSON parse failed.";
        } else if (exception === "timeout") {
          msg = "Time out error.";
        } else if (exception === "abort") {
          msg = "Ajax request aborted.";
        } else {
          msg = "Uncaught Error.\n" + jqXHR.responseText;
        }
        alert(msg);
      },
    });
  });
});
