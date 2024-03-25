#include <Arduino.h>
#include <shift_register.h>
#include <Led.h>
#include "HCSR04.h"


#define TRIGGER_PIN D1
#define ECHO_PIN D2

ShiftRegister reg(D5,D6,D7);
Led leds(&reg,D3,D4);

int buzzer=D8;
UltraSonicDistanceSensor ultrasonicSensor(TRIGGER_PIN, ECHO_PIN);
