		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

            <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
            <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
            <script>
                $(function(){
                    
                    $("#DiakRegform").validate({
                        //Ezekkel neked nem kell foglalkozni!
                        rules:{
                            vezeteknev: {
                              required: true,
                              alphanumeric: true,
                              minLenght: 3,
                              nowhitespce: true,
                                
                            },
                            keresztnev:{
                              required: true,
                              alphanumeric: true,
                              minLenght: 3,
                              nowhitespce: true,
                            },
                            email:{
                              required: true,
                              email: true,
                              nowhitespce: true,
                            },
                            jelszo:{
                                required: true,
                                minLenght: 6,
                                nowhitespce: true,
                            },
                            jelszo_ujra:{
                              required: true,
                              equalTo: '#jelszo',
                              nowhitespce: true,
                            },
                            telefonszam:{
                              required: true,
                              nowhitespce: true,
                                number: true,
                              
                            },
                            diakigazolvany_szam:{
                                required: true,
                                number: true,
                            },
                        },
                        //Norbi neked innen lesz majd dolgod!!
                        message:{
                            vezeteknev:{
                                //itt tudod meg adni hogy mit írjon ki ha nem volt valid és ide kell majd neki adnod a css-t meg a html taged ha akarsz!!!!
                                //Ide azokat írsz amiket szeretnél szerintem érted mik vannak oda írva ha nem akkor írj 
                                required: 'Ez a mező kötelező',
                                alphanumeric: 'ALfanumerikus', 
                                minLenght: 'minimumhossz',
                                nowhitespce: 'üres?',   
                            },
                            keresztnev:{
                                required: 'Ez a mező kötelező',
                                alphanumeric: '', 
                                minLenght: '',
                                nowhitespce: '',   
                            },
                            email:{
                                required: '',
                                email: '',
                                nowhitespce: '',
                            },
                            jelszo:{
                                required: '',
                                minLenght: '',
                                nowhitespce: '',
                            },
                            jelszo_ujra:{
                                required: '',
                                nowhitespce: '',
                            },
                            telefonszam:{
                                required: '',
                                nowhitespce: '',
                                number: '',
                            },
                            diakigazolvany_szam:{
                                required: '',
                                number: '',
                            },
                        },
                    });
                    //Nehogy azt hidd, hogy vége :D, nem nem tudtam meg csinálni úgy hogy egybe legyen ez a szar xDD
                    $('#Munkaado_Reg').validate({
                        rules:{
                            vezeteknev: {
                              required: true,
                              alphanumeric: true,
                              minLenght: 3,
                              nowhitespce: true,
                                
                            },
                            keresztnev:{
                              required: true,
                              alphanumeric: true,
                              minLenght: 3,
                              nowhitespce: true,
                            },
                            email:{
                              required: true,
                              email: true,
                              nowhitespce: true,
                            },
                            jelszo:{
                                required: true,
                                minLenght: 6,
                                nowhitespce: true,
                            },
                            jelszo_ujra:{
                              required: true,
                              equalTo: '#jelszo',
                              nowhitespce: true,
                            },
                            telefonszam:{
                              required: true,
                              nowhitespce: true,
                                number: true,
                              
                            },
                        },
                        message:{
                            vezeteknev:{
                                //itt tudod meg adni hogy mit írjon ki ha nem volt valid és ide kell majd neki adnod a css-t meg a html taged ha akarsz!!!!
                                //Ide azokat írsz amiket szeretnél szerintem érted mik vannak oda írva ha nem akkor írj 
                                
                                required: 'Ez a mező kötelező',
                                alphanumeric: '', 
                                minLenght: '',
                                nowhitespce: '',   
                            },
                            keresztnev:{
                                required: 'Ez a mező kötelező',
                                alphanumeric: '', 
                                minLenght: '',
                                nowhitespce: '',   
                            },
                            email:{
                                required: '',
                              email: '',
                              nowhitespce: '',
                            },
                            jelszo:{
                                 required: '',
                                minLenght: '',
                                nowhitespce: '',
                            },
                            jelszo_ujra:{
                                required: '',
                              nowhitespce: '',
                            },
                            telefonszam:{
                                required: '',
                              nowhitespce: '',
                                number: '',
                            },
                        },
                    });
                });
               
            </script>
	</body>
</html>