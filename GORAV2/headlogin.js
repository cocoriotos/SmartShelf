fetch("headlogin.html")
				.then(response => response.text())
				.then(data => {
					document.head.innerHTML += data;
				});