
#include "header.h"
void setup()
{
  Serial.begin(9600);
  reg.init();
}

void loop()
{
  for (int i = 1; i < 9; i++){
    reg.led(i, HIGH);
    delay(1000);
      }
  reg.allOff();
  delay(2000);
  reg.allOn();
  delay(2000);
  for (int i = 1; i < 9; i++){
    reg.led(i, LOW);
    delay(1000);
  }
  reg.allOn();
  delay(1000);


}
