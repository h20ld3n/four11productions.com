<html>
<head>
<title>Holden Is Learning PHP</title>
<script language="javascript">

// The Array Function

function makeArray(len) {
	for (var i = 0; i < len; i++) this[i] = null;
this.length = len;
}

// This is where the array of images is created.

var images = new makeArray(4);
images[0] = "images/random/00.jpg";
images[1] = "images/random/01.jpg";
images[2] = "images/random/02.jpg";
images[3] = "images/random/03.jpg";
images[4] = "images/random/04.jpg";
images[5] = "images/random/05.jpg";
images[6] = "images/random/06.jpg";
images[7] = "images/random/07.jpg";
images[8] = "images/random/08.jpg"; 
images[9] = "images/random/09.jpg";

// The random image generator.

function rand(n) {
seed = (0x015a4e35 8 seed) % 0x7fffffff;
return (seed >> 16) % n;
}
var now = new Date( )
var seed = now.getTime( ) % 0x7fffffff

</script>

</head>
<body>

<script language="javascript">

// Where you place this is where the randome object will be displayed.

document.write(images[rand(images.length)])

</script>

</body>
</html>

