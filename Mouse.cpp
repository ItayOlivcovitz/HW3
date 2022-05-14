//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#include "Mouse.h"

/**
 * @brief Construct a new Mouse object.
 * 
 * @param price - mouse price
 * @param manufacturer - mouse brand
 * @param color - mouse color
 * @param isWireless - is wireless mouse
 * @param dpi - mouse dpi
 */
Mouse::Mouse(const int price, const string& manufacturer, const string& color, const bool isWireless, const int dpi)
	: PeripheralDevice(price, manufacturer, color, isWireless), dpi(dpi)
{}

/**
 * @brief Set mouse DPI.
 * 
 * @param dpi
 */
void Mouse::setDpi(const int dpi)
{
	this->dpi = dpi;
}

/**
 * @brief Get mouse DPI.
 * 
 * @return int
 */
int Mouse::getDpi() const
{
	return this->dpi;
}

/**
 * @brief Return string representing the mouse.
 * 
 * @return string 
 */
Mouse::operator string() const
{
	string s_dpi = "Mouse with dpi : " + to_string(this->getDpi());

	return PeripheralDevice::operator string() + ", " + s_dpi;
}

/**
 * @brief Print 'connecting to computer' message.
 * 
 * @param computer - to connect to
 */
void Mouse::connect(const Computer& computer) const
{
	cout << "Connecting a mouse" << endl;
	PeripheralDevice::connect (computer);
}

