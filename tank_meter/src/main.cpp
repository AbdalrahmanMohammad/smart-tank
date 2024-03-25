// Include the SPI library for communication with 74HC595
// Define the pins connected to 74HC595
// #define DATA_PIN D5  // Serial Data Input (DS)
// #define CLOCK_PIN D6 // Serial Clock Input (SH_CP)
// #define LATCH_PIN D7 // Storage Register Clock Input (ST_CP)
#include "header.h"
void setup()
{
  reg.init();
}

void loop()
{
  reg.allOff();
  delay(1000);
  reg.allOn();
  delay(1000);
}
