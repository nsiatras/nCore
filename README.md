nCore - Simple, Secure and Fast MySQL connector for PHP
=======

## How to Use
To better undersand how to use nCore read the code inside the <b>[nCore_Test.php](https://github.com/nsiatras/nCore/blob/main/nCore_Test.php)</b> file


 #### How to insert data
```
$sql = 'INSERT INTO `Employees` (`FirstName`,`LastName`,`Email`,`PhoneNumber`,`Salary`) VALUES (?,?,?,?,?)';
$command = new MySQLCommand($connection, $sql);
$command->Parameters->setString(1, "Nikos");
$command->Parameters->setString(2, "Siatras");
$command->Parameters->setString(3, "email@email.com");
$command->Parameters->setInteger(4, 2100000000);
$command->Parameters->setDouble(5, 1000);
$command->ExecuteQuery();
$recordID = $command->$command->getLastInsertID(); // This returns the Auto Increment ID
echo 'New employee inserted. Record ID is ' . $recordID . '<br>';
```
#### How to read data
```
$sql = "SELECT `ID`,`FirstName`,`LastName`,`Salary` FROM `Employees` WHERE `Saralary`> ?";
$command = new MySQLCommand($connection, $sql);
$command->Parameters->setInteger(1, 1000);
$reader = $command->ExecuteReader();
while ($reader->Read())
{
    $employeeID = $reader->getValue(0);
    $firstName = $reader->getValue(1);
    $lastName = $reader->getValue(2);
    $salary = $reader->getValue(3);

    echo $firstName . " " . $lastName . " salary is " . $salary;
}
$reader->Close();
```