//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#ifndef KEYBOARD_H
#define KEYBOARD_H

#include "PeripheralDevice.h"
#include "Computer.h"
#include <string>
#include <iostream>

using std::string;
using std::to_string;
using std::cout;
using std::endl;

class Keyboard : public PeripheralDevice
{
private:
	int numOfKeys;

public:

	/**
	 * @brief Construct a new Keyboard object.
	 * 
	 * @param price - keyboard price
	 * @param manufacturer - keyboard brand
	 * @param color - keyboard color
	 * @param isWireless - is the keyboard wireless
	 * @param numOfKeys - number of keyies in keyboard
	 */
	Keyboard(const int price, const string& manufacturer, const string& color, const bool isWireless, const int numOfKeys);
	
	/**
	 * @brief Set number of keys in keyboard.
	 * 
	 * @param numOfKeys - keys in keyboard
	 */
	void setNumOfKeys(const int numOfKeys);

	/**
	 * @brief Get number of keys in keyboard.
	 * 
	 * @return int
	 */
	int getNumOfKeys() const;

	/**
	 * @brief Return string representing this keyboard.
	 * 
	 * @return string 
	 */
	operator string() const override;

    /**
     * @brief Print connecting this kayboard to computer.
     * 
     * @param computer - to be connected into
     */
	void connect(const Computer& computer) const override;
};

#endif /* KEYBOARD_H */