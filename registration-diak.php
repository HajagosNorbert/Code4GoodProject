<head>
<title>Diák regisztració</title>
</head>
<body>
    <form name="diak" method="post">
        <p>Vezekénév: <input type="text" name="vezeteknev" placeholder="vezetéknév"></p>
        <p>Keresztnév: <input type="text" name="keresznev" placeholder="keresztnév"></p>
        <p>Jelszó: <input type="password" name="password" placeholder="jelszó"></p>
        <p>E-mail cím: <input type="email" name="email" placeholder="email"></p>
        <p>Telefonszám: <input type="text" name="phonenumber" placeholder="telefonszám"></p>
        <p>Diákigazolványszám (11 számjegyű): <input type="text" name="diákszám" maxlength="11" placeholder="diákigazolványszám"></p>
        <p>Iskolák
            <select name="schools">
                <option value=""></option>
            </select>
        </p>
        <p><input type="submit" name="submit"></p>
    </form>
</body>