#include <header.h>
#include <func.h>

void setup()
{
  Serial.begin(9600);
  leds.init();
  pinMode(buzzer, OUTPUT);
  pinMode(wifiLed, OUTPUT);
  connect_wifi();
}

void loop()
{
  checkWifi();

float x=measure(30);
  Serial.print("Distance: ");
  Serial.print(x);
  sendReadings(x);
  Serial.println(" cm");
  for (int i = 1; i <= 10; i++)
  {
    leds.controlLed(i, HIGH);
    delay(300);
  }
  leds.allOff();
  delay(1000);
  leds.allOn();
  delay(1000);
  for (int i = 1; i <= 10; i++)
  {
    leds.controlLed(i, LOW);
    delay(300);
  }
  leds.allOn();
  delay(1000);
}
