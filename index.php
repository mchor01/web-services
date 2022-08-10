<html>
<head> 
<title>Pokemon Service</title>
<style>
	body {font-family:georgia;}
  .pokemon{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  .pic img{
	max-width:50px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
  
function pokeTemplate(pokemon){
  return `
    <div class="pokemon">
      <b>Film</b>: ${pokemon.Number}<br/>
      <b>Title</b>:${pokemon.Name}<br/>
      <b>Year</b>:${pokemon.Type}<br/>
      <b>Ability</b>:${pokemon.Ability}<br />
      <b>HP</b>:${pokemon.HP} <br />
      <b>Atk</b>:${pokemon.Atk}<br/>
      <div class="pic"><img img src="pokemon/${pokemon.Image}" /></div>
    </div>
  `;
}
  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

    // //using JSON.stringify we can view the data on the page
    //   let myData = JSON.stringify(data, null, 4);
    //  myData = "<pre>" + myData + "</pre>";
    // $('#output').html(myData);

     //clear the previous films
     $("#pokemons").html("");
     //use data.title to show the order of films
     $("#pokemontitle").html(data.title);

     //loop through data.films and add to #films div
     $.each(data.pokemon,function(i,item){
      let myPoke = pokeTemplate(item);

       $("<div></div>").html(myPoke).appendTo("#pokemons");
     });
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 



</script>
</head>
	<body>
	<h1>Pokemon Web Service</h1>
  <p>This Site will display a list of Pokemon and Legendary Pokemon from a database.</p>
  <p>Click on the links to display the associated list.</p>
		<a href="pokemon" class="category">Regular Pokemon</a><br />
		<a href="legendary" class="category">Legendary Pokemon</a>
		<h3 id="pokemontitle">--</h3>
		<div id="pokemons">
      
<!--       <div class="film">
            <b>Film</b>: 1<br />
            <b>Title</b>:Dr. No<br />
            <b>Year</b>: 1962<br />
            <b>Director</b>: Terence Young<br />
            <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br />
            <b>Writers</b>:Richard Maibaum, Johanna Harwood and Berkely Mather<br />
            <b>Composer</b>: Monty Norma<br />
            <b>Bond</b>: Sean Connery<br />
      <b>Budget</b>: $1,000,000.00<br />
      <b>BoxOffice</b>: $59,567,035.00<br />
            <div class="pic"><img img src="thumbnails/dr-no.jpg" /></div>
          
      </div> -->
      
    </div>
		<div id="output"></div>
	</body>
</html>