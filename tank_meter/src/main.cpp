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
  // Serial.print("Distance: ");
  // Serial.print(x);
  // Serial.println(" cm");
  
  // sendReadings(x);
  controlLeds(x);
}
