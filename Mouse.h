//Student1 Daniel Penkov, penkovdany@gmail.com, 207925504
//Student2 Itay Olivcovitz, Itay.olivcovitz@gmail.com, 207745639

#ifndef MOUSE_H
#define MOUSE_H

#include "PeripheralDevice.h"
#include "Computer.h"
#include <string>
#include <iostream>

using std::string;
using std::to_string;
using std::cout;
using std::endl;

class Mouse :public PeripheralDevice
{
private:
	int dpi;

public:

	/**
	 * @brief Construct a new Mouse object.
	 * 
	 * @param price - mouse price
	 * @param manufacturer - mouse brand
	 * @param color - mouse color
	 * @param isWireless - is wireless mouse
	 * @param dpi - mouse dpi
	 */
	Mouse(const int price, const string& manufacturer, const string& color , const bool isWireless, const int dpi);

	/**
	 * @brief Set mouse DPI.
	 * 
	 * @param dpi
	 */
	void setDpi(const int dpi);

	/**
	 * @brief Get mouse DPI.
	 * 
	 * @return int
	 */
	int getDpi() const;
	
	/**
	 * @brief Return string representing the mouse.
	 * 
	 * @return string 
	 */
	operator string() const override;

	/**
	 * @brief Print 'connecting to computer' message.
	 * 
	 * @param computer - to connect to
	 */
	void connect(const Computer& computer) const override;
};

#endif /* MOUSE_H */