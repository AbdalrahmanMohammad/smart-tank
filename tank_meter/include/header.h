#include <Arduino.h>
#include <shift_register.h>
#include <Led.h>

ShiftRegister reg(D5,D6,D7);
Led leds(&reg,D3,D4);

int buzzer=D8;