const data = null;

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
	if (this.readyState === this.DONE) {
		console.log(this.responseText);
	}
});

xhr.open("GET", "https://realtor.p.rapidapi.com/mortgage/calculate?hoi=56.0&tax_rate=1.2485549449920654&downpayment=44980&price=224900&term=30.0&rate=3.827");
xhr.setRequestHeader("x-rapidapi-key", "6288b04b82msh924ce912f68ff81p1c951cjsn7b55d5b23d03");
xhr.setRequestHeader("x-rapidapi-host", "realtor.p.rapidapi.com");

xhr.send(data);