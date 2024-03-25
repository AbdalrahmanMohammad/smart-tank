
#ifndef shift_register_h
#define shift_register_h

#include <Arduino.h>
#include <SPI.h>

class ShiftRegister
{
private:
    byte dataPin;
    byte clockPin;
    byte latchPin;

    int leds;

public:
    ShiftRegister(byte dataPin, byte clockPin, byte latchPin)
    {
        this->dataPin = dataPin;
        this->clockPin = clockPin;
        this->latchPin = latchPin;

        leds = 0b00000000;
    }

    void init()
    {
        pinMode(dataPin, OUTPUT);
        pinMode(clockPin, OUTPUT);
        pinMode(latchPin, OUTPUT);
        apply();
    }

    void apply()
    {
        digitalWrite(latchPin, LOW);
        shiftOut(dataPin, clockPin, LSBFIRST, leds);
        digitalWrite(latchPin, HIGH);
    }

    void allOn()
    {
        leds = 0b11111111;
        apply();
    }

    void allOff()
    {
        leds = 0b00000000;
        apply();
    }

    void led(byte ledNumber, boolean state)
    {
       
    }
};

#endif
