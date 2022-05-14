#ifndef PERIPHERALDEVICE_H
#define PERIPHERALDEVICE_H

#include "Computer.h"
#include <iostream>
#include <string>

using std::string;
using std::cout;
using std::endl;

class PeripheralDevice : public Item
{
private:
    string color;
    bool isWireless;

public:

    /**
     * @brief Construct a new Peripheral Device.
     * 
     * @param price - device's price
     * @param manufacturer - device's brand
     * @param color - device's color
     * @param isWireless - is the device wireless
     */
    PeripheralDevice (const int price, const string& manufacturer, const string& color, const bool isWireless);

    /**
     * @brief Get device's color.
     * 
     * @return string
     */
    string getColor () const;

    /**
     * @brief Set device's color.
     * 
     * @param color - device's new color
     */
    void setColor (const string& color);

    /**
     * @brief Check if the device wireless.
     * 
     * @return true - the device wireless
     * @return false - the device wired
     */
    bool getIsWireless () const;

    /**
     * @brief Set if the the device wireless.
     * 
     * @param isWireless - True to set the device wireless
     */
    void setIsWireless (const bool isWireless);

    /**
     * @brief Return string representing this peripheral device.
     * 
     * @return string 
     */
    virtual operator string() const override = 0;

    /**
     * @brief Connecting this device to computer.
     * 
     * @param computer - to be connected into
     */
    virtual void connect (const Computer& computer) const = 0;
};

#endif /* PERIPHERALDEVICE_H */