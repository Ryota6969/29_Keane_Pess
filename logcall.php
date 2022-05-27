<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Police Emergency Service System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" > </script>
</head>

<body bgcolor="#a6a6a6">
<style>
img {
display: block;
margin-left: auto;
margin-right: auto;
}
</style>
<script>
function Ryota()
{
var x=document.forms["frmLogCall"]
["callerName"].value;
if (x==null || x=="")
{
alert("Caller Name is required.");
return false;
}
}
</script>
<?php require_once 'nav.php';
?>
<?php require_once 'db.php';
	
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
if($conn->connect_error) 
{
die("Connection failed: ". $conn->connect_error);
}
$sql = "SELECT * FROM incidenttype";

$result = $conn-> query($sql);
if ($result->num_rows > 0) 
{
while ($row = $result-> fetch_assoc())
{
$incidentType[$row['incidentTypeId']] = $row['incidentTypeDesc'];
}
}
$conn->close();
?>
<fieldset>
<legend>Log Call</legend>
<form name="frmLogCall" method="post" action="dispatch.php" onSubmit="return Ryota();">
<table width="45%" border="2" align="center" cellpadding="5" cellspacing="5">
<tr>
<td width="20%" align="center">Name of Caller:</td>
<td width="50%"><input type="text"  name="callerName" id="callerName" pattern="[a-zA-Z- ]+" placeholder="Name" oninvalid="setCustomValidity('Please enter on alphabets only. ')" onkeypress="return onlyAlphabets(event,this);">
	<br>
	<small style="color: #000000">*Name Required</small></td>
</tr>
	
<tr>
<td width="20%" align="center">Contact Number:</td>
<td width="50%"><input type="tel" pattern="[6,8,9]{1}[0-9]{7}"  placeholder="Number" maxlength="8"  name="contactNo" id="contactNo" title="A number starting with 6, 8 or 9 " required>
<br>
<small style="color: #000000">*Number must start with 6/8/9</small></td>
</tr>
	
<tr>
<td width="50%" align="center">Location:</td>
<td width="50%"><input type="text" name="location" id="location">
<br>
<small style="color: #000000">*Location Required</small></td>
</tr>
	
<tr>
<td width="50%" align="center">Incident Type:</td>
<td width="50%"><select name="incidentType" id="incidentType">
<?php foreach($incidentType as $key=> $value) {?>
<option value="<?php echo $key ?> " ><?php echo $value?> </option> <?php } ?>
</select>
</td>
</tr>
	
<tr>
<td width="50%" align="center">Description:</td>
<td width="50%"><textarea name="incidentDesc" id="incidentDesc" cols="45" rows="5"></textarea></td>
</tr>
	
<tr>
<table width="40%" border="0" align="center" cellpadding="5" cellspacing="5">
<td align="center">
<input type="reset" name="cancelProcess" id="cancelProcess" value="Reset"
</td>
<td align="center">
<input type='submit' name="btnProcessCall" id="btnProcessCall" value="Process Call"
</td>
</table>
</tr>
</table>
</form>
</fieldset>
</body>
	<script>
	function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32)
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }
	</script>
	<script>
     $(function() {
        $("input[name='contactNo']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });
</script>
<script>
    function onlynum() {
        var fm = document.getElementById("form2");
        var ip = document.getElementById("num");
        var tag = document.getElementById("value");
        var res = ip.value;

        if (res != '') {
            if (isNaN(res)) {

                // Set input value empty
                ip.value = "";

                // Reset the form
                fm.reset();
                return false;
            } else {
                return true
            }
        }
    }
</script>
</html>