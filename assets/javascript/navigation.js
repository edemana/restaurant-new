const navigation = document.querySelector(".navigation");
      const mainContent = document.querySelector(".main-content");
      const toggle = document.querySelector(".toggle");

      toggle.onclick = function () {
        navigation.classList.toggle("active");
        mainContent.classList.toggle("active");
      };

      const menuItems = document.querySelectorAll(".navigation ul li a");
      menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
          menuItems.forEach((i) => i.classList.remove("active"));
          this.classList.add("active");
        });
      });