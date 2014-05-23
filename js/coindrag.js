 /* $(function() {
        var bool = false;
        var eCan = document.getElementById('canimgholder');
        if (eCan) {
            eCan.onclick = function() {
                location.href = "automaatcontroller.php";
            }
        }
        $(".muntenholder").on("mouseup",".muntimg",
                function() {
                    console.log(saldo.munten)
                    console.log($(this).attr('id'));
                    console.log($(this).position()['left'])
                    console.log($(this).position()['top'])
                    if ($(this).position()['top'] > -490 && $(this).position()['top'] < -450) {
                        var id= $(this).attr('id');
                        switch ($(this).attr('id')) {
                            case '10':
                                if ($(this).position()['left'] > 170 && $(this).position()['left'] < 210) {
                                var id= $(this).attr('id');
                                
                                    $(this).position['top']=0;
                                    //self.location.href = "automaatcontroller.php?action=steekgeldin&id=" + $(this).attr('id');
                                }
                                break;
                            case "20":
                                if ($(this).position()['left'] > 140 && $(this).position()['left'] < 180) {
                               //self.location.href = "automaatcontroller.php?action=steekgeldin&id=" + $(this).attr('id');
                                }
                                break;
                            case "50":
                                 if ($(this).position()['left'] > 105 && $(this).position()['left'] < 145) {
                                 //self.location.href = "automaatcontroller.php?action=steekgeldin&id=" + $(this).attr('id');
                                 }
                                break;
                            case "100":
                                if ($(this).position()['left'] > 70 && $(this).position()['left'] < 110) {
                                 //self.location.href = "automaatcontroller.php?action=steekgeldin&id=" + $(this).attr('id');
                                }
                                break;
                            case "200":
                                if ($(this).position()['left'] > 40 && $(this).position()['left'] < 80) {
                                //self.location.href = "automaatcontroller.php?action=steekgeldin&id=" + $(this).attr('id');
                                }
                                break;

                        }
                        $.each(saldo.munten, function(key){
                            if (key==id){
                                saldo.munten[key]+=1;
                            }
                        })
                        
                        
                    }
                }
        );
   });*/