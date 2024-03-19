jQuery(function ($) {
  $(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
      $(".sidebar-dropdown").removeClass("active");
      $(this).parent().removeClass("active");
    } else {
      $(".sidebar-dropdown").removeClass("active");
      $(this).next(".sidebar-submenu").slideDown(200);
      $(this).parent().addClass("active");
    }
  });

  $("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
  });
  $("#show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
  });
});

//Xóa đề tài.

function changeStatus(id, value) {
  $.ajax({
    url: "handle/xulytrangthai.php",
    method: "POST",
    data: {
      id: id,
      value: value,
    },
    success: (data) => {
      alert(data.trim());
      window.location.reload();
    },
  });
}

$(document).on("click", ".mamon", function () {
  if (confirm("Bạn muốn đổi trạng thái món này?")) {
    var id = $(this).data("idmon");
    var status = getValue();
    console.log(id, status);

    changeStatus(id, status);
  }
});

function getOrder(mapdm) {
  $.ajax({
    type: "POST",
    url: "./handle/loadorder.php",
    data: {
      mapdm: mapdm,
      act: "PDM",
    },
    success: function (response) {
      // location.reload();
      $("#detail_order").html(response);
      $("#exampleModalLabel").html("Chi tiết phiếu đặt món: " + mapdm);
    },
  });
}

$(document).on("click", ".detail_order", function () {
  var ma = $(this).data("mapdm");

  getOrder(ma);
});

// $.each($('.detail_order'), function(indexInArray, valueOfElement) {
//   valueOfElement.addEventListener('click', (e) => {
//     const mapdm = (e.target.dataset.mapdm);
// $.ajax({
//       type: "POST",
//       url: "./handle/loadorder.php",
//       data: {
//         mapdm,
//         act: 'PDM'
//       },
//       success: function(response) {
//         // location.reload();
//         $('#detail_order').html(response);
//       }
//     });

//   })
// });
