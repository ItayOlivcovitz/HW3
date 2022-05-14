//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#include "Keyboard.h"

/**
 * @brief Construct a new Keyboard object.
 * 
 * @param price - keyboard price
 * @param manufacturer - keyboard brand
 * @param color - keyboard color
 * @param isWireless - is the keyboard wireless
 * @param numOfKeys - number of keyies in keyboard
 */
Keyboard::Keyboard(const int price, const string& manufacturer, const string& color, const bool isWireless, const int numOfKeys)
	: PeripheralDevice(price, manufacturer, color, isWireless), numOfKeys(numOfKeys)
{}

/**
 * @brief Set number of keys in keyboard.
 * 
 * @param numOfKeys - keys in keyboard
 */
void Keyboard::setNumOfKeys(const int numOfKeys)
{
	this->numOfKeys = numOfKeys;
}

/**
 * @brief Get number of keys in keyboard.
 * 
 * @return int
 */
int Keyboard::getNumOfKeys() const
{
	return this->numOfKeys;
}

/**
 * @brief Return string representing this keyboard.
 * 
 * @return string 
 */
Keyboard::operator string() const
{
	string s_keyboard = "Keyboard with " + to_string(this->getNumOfKeys()) + " keys";

	return PeripheralDevice::operator string() + ", " + s_keyboard;
}

/**
 * @brief Print connecting this kayboard to computer.
 * 
 * @param computer - to be connected into
 */
void Keyboard::connect(const Computer & computer) const
{
	cout << "Connecting a keyboard" << endl;
	PeripheralDevice::connect (computer);
}

