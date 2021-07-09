<?php
require 'connection.php';
                            $query="SELECT * FROM data_train";
                            $result=mysqli_query($conn,$query);
                            if(mysqli_num_rows($result)>0){
                                while($row=mysqli_fetch_assoc($result)){
                                    echo "<tr>".
                                            "<td>".$row['jenis_kelamin']."</td>".
                                            "<td>".$row['status_rumah']."</td>".
                                            "<td>".$row['status']."</td>".
                                            "<td>".$row['jumlah_tanggungan']."</td>".
                                            "<td>".$row['profesi']."</td>".
                                            "<td>".$row['penghasilan']."</td>".
                                            "<td>".$row['kartu_kredit']."</td>".
                                            "<td><button class='btn btn-danger fas fa-trash' onclick='delete_data(".$row['id'].");'></button></td>".
                                        "</tr>";
                                }
                            }
                        ?>