// Include the SPI library for communication with 74HC595
#include <SPI.h>

// Define the pins connected to 74HC595
#define DATA_PIN D5    // Serial Data Input (DS)
#define CLOCK_PIN D6   // Serial Clock Input (SH_CP)
#define LATCH_PIN D7   // Storage Register Clock Input (ST_CP)

void setup() {
 
  pinMode(DATA_PIN, OUTPUT);
  pinMode(CLOCK_PIN, OUTPUT);
  pinMode(LATCH_PIN, OUTPUT);


}

void loop() {
  // Toggle LEDs on and off
  for(int i=0;i<=255;i++)
  {
 digitalWrite(LATCH_PIN,LOW);
 shiftOut(DATA_PIN,CLOCK_PIN,LSBFIRST,i);
 digitalWrite(LATCH_PIN,HIGH);
 delay(50);
  }
}

