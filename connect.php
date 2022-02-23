<?

$Username = $_POST['Username'];
$Phonenumber = $_POST['Phonenumber'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];

if(!empty($Firstname) || !empty($Lastname) || !empty($Email) || !empty($Password)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "ecommerce";
}


//create connection
$conn = new mysqli($host, $dbUsername,$dbPassword,$dbname);

if (mysqli_connect_error()) {
    die('connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
}else{
    $SELECT = "SELECT email from register Where email = ? Limit 1"; 
    $INSERT = "INSERT Into register (Username, Phonenumber, Email, Password) values(?,?,?,?)";   
    
    //Prepare statement
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->excute();
    $stmt->bind_result($Email);
    $stmt->store_result();

    if($rnum==0) {
        $stmt->close();
        $stmt=$conn->prepare($INSERT);
        $stmt->bind_param("siss", $Username,$Phonenumber,$Email,$Password);
        $stmt->excute();
        echo "New record inserted sucessfully";
    }else{
        echo "Someone already register using this email";
    }
    $stmt->close();
    $conn->close();

} 

else{
    echo "All filed are required";
    die();
}


?> 