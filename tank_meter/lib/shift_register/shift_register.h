
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

    void init() // initialize
    {
        pinMode(dataPin, OUTPUT);
        pinMode(clockPin, OUTPUT);
        pinMode(latchPin, OUTPUT);
        apply();
    }

    void apply() // apply the change
    {
        digitalWrite(latchPin, LOW);
        shiftOut(dataPin, clockPin, LSBFIRST, leds);
        digitalWrite(latchPin, HIGH);
    }

    void allOn() // turn all LEDs on
    {
        leds = 0b11111111;
        apply();
    }

    void allOff() // turn all LEDs off
    {
        leds = 0b00000000;
        apply();
    }

    void led(byte ledNumber, boolean state) // change the state of a specified LED
    {
        if (state)
            leds |= (1 << (ledNumber - 1)); // Set the bit representing the LED
        else
            leds &= ~(1 << (ledNumber - 1)); // Clear the bit representing the LED
        apply();
    }
};

#endif
