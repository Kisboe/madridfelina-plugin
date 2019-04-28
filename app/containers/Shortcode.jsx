import React from "react";
import PropTypes from "prop-types";

const Shortcode = () => (
  <div>
    <h1>WP Reactivate Frontend</h1>
    <p>Title: {this.props.wpObject.title}</p>
  </div>
);

Shortcode.propTypes = {
  wpObject: PropTypes.object
};

export default Shortcode;
