 //form validition változók létrehozás.
                var vezeteknev = document.forms["diak_reg"]["vezeteknev"];
                var keresztnev = document.forms["diak_reg"]["keresztnev"];
                var email = document.forms["diak_reg"]["email"];
                var jelszo = document.forms["diak_reg"]["jelszo"];
                var jelszo_ujra = document.forms["diak_reg"]["jelszo_ujra"];
                var telefonszam = document.forms["diak_reg"]["telefonszam"];
                var diakigazolvany_szam = document.forms["diak_reg"]["diakigazolvany_szam"];

                // Meg nézem, hogy mindenben van-e valami.
                function Validate() {
                    if (vezeteknev.value == "") {
                        vezeteknev.style.border = "1px solid red";
                        alert("A vezetéknév mező nem lehet üres!");
                        return false;
                    }

                    if (keresztnev.value == "") {
                        keresztnev.style.border = "1px solid red";
                        alert("A keresztnév mező nem lehet üres!");
                        return false;
                    }

                    if (email.value == "") {
                        email.style.border = "1px solid red";
                        alert("Az email mező nem lehet üres!");
                        return false;
                    }

                    if (jelszo.value == "") {
                        jelszo.style.border = "1px solid red";
                        alert("A jelszó mező nem lehet üres!");
                        return false;
                    }

                    if (jelszo_ujra.value == "") {
                        jelszo_ujra.style.border = "1px solid red";
                        alert("A keresztnév mező nem lehet üres!");
                        return false;
                    }

                    if (telefonszam.value == "") {
                        telefonszam.style.border = "1px solid red";
                        alert("A keresztnév mező nem lehet üres!");
                        return false;
                    }

                    if (diakigazolvany_szam.value == "") {
                        diakigazolvany_szam.style.border = "1px solid red";
                        alert("A diákigazolvány szám mező nem lehet üres!");
                        return false;
                    }
                    //Megnézem, hogy a telefonszám hossza valid-e.
                    if (telefonszam.lenght == 7) {
                        telefonszam.style.border = "1px solid red";
                        alert("A telefonszám nem igazi, túl hosszú.");
                        return false;
                    } else {
                        telefonszam.style.border = "1px solid green";
                        return true;
                    }

                    //Megnézem, hogy a kettő jelszó egyezik-e.

                    if (jelszo.value != jelszo_ujra.vale) {
                        jelszo_ujra.style.border = "1px solid red";
                        jelszo.stel.border = "1px solid red";
                        alert("A kettő jelszónak egyeznie kell.");
                        return false;
                    } else {
                        jelszo_ujra.style.border = "1px solid green";
                        jelszo.stel.border = "1px solid green";
                        return true;
                    }

                    //Megnézem, hogy ahol karakternek kell lennie ott csak karakter legyen. 
                    if (vezeteknev.value.includes(Number)) {
                        alert("A vezetéknév nem tartalmazhat számot.");
                        return false;
                    }

                    if (keresztnev.value.includes(Number)) {
                        alert("A keresztnév nem tartalmazhat számot.");
                        return false;
                    }

                    if (telefonszam.value.includes(String)) {
                            alert("A telefonszám nem tartalmazhat betűt.");
                            return false;
                        }
                        if (diakigazolvany_szam.value.includes(String)) {
                            alert("A diákigazolványod nem tartalmaz betűt.");
                            return false;
                        }
                        //Meg nézem, hogy az emailben meg van-e minden.
                        if (email.value.includes("@", ".")) {

                        } else {
                            alert("Kihagytad a @ jelet.");
                            return false;
                        }
                }
                