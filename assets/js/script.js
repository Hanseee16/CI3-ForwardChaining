document.addEventListener("DOMContentLoaded", function () {
	var navbar = document.querySelector(".navbar");
	var lastScrollTop = 0;

	function checkScroll() {
		var scrollTop = window.scrollY;

		// Sembunyikan navbar saat scroll ke bawah
		if (scrollTop > lastScrollTop && scrollTop > 50) {
			navbar.classList.add("hidden");
		} else {
			navbar.classList.remove("hidden");
		}

		// Ubah navbar menjadi solid setelah scroll 50px
		if (scrollTop > 50) {
			navbar.classList.add("solid");
		} else {
			navbar.classList.remove("solid");
		}

		lastScrollTop = scrollTop;
	}

	// Jalankan saat halaman dimuat dan saat scroll
	window.addEventListener("scroll", checkScroll);
	checkScroll();
});
