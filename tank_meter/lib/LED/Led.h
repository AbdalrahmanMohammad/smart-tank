
#ifndef Led_h
#define Led_h

#include <Arduino.h>
#include "shift_register.h"

class Led
{
private:
    ShiftRegister *reg;
    int led9;
    int led10;

public:
    Led(ShiftRegister *reg, int led9, int led10)
    {
        this->reg = reg;
        this->led9 = led9;
        this->led10 = led10;
    }

    void init() // initialize
    {
        pinMode(led10, OUTPUT);
        pinMode(led9, OUTPUT);
        reg->init();
    }

    void allOn() // turn all LEDs on
    {
        reg->allOn();
        digitalWrite(led9, HIGH);
        digitalWrite(led10, HIGH);
    }

    void allOff() // turn all LEDs off
    {
        reg->allOff();
        digitalWrite(led9, LOW);
        digitalWrite(led10, LOW);
    }

    void controlLed(byte ledNumber, boolean state) // change the state of a specified LED
    {
        if (ledNumber > 10 || ledNumber < 1) // just from 1 to 10
            return;
        else if (ledNumber <= 8 && ledNumber >= 1) // if it's from 1 to 8 control it from shift_register class
            reg->controlLed(ledNumber, state);

        else // if it's led 9 or led 10
        {
            if (ledNumber == 9)
                digitalWrite(led9, state);
            else if (ledNumber == 10)
                digitalWrite(led10, state);
        }
    }
};

#endif
